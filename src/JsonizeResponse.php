<?php

namespace RobRogers3\LaravelExceptionHandler;

use Illuminate\Translation\Translator as Lang;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use RobRogers3\LaravelExceptionHandler\Exceptions\MessagingException;

trait JsonizeResponse
{
    /** @var int */
    protected $statusCode;

    /** @var mixed */
    protected $message;
    
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return JsonResponse
     */
    public function renderJson($request, \Exception $exception)
    {
        $this->marshallResponseData($exception);
        
        return $this->prepareJsonResponse($exception);
    }

    /**
     * @param  \Exception               $exception
     *
     * @return JsonResponse
     */
    protected function prepareJsonResponse(\Exception $e)
    {
        $headers = $this->isHttpException($e) ? $e->getHeaders() : [];

        return JsonResponse::create(
            $this->message,
            $this->statusCode ?: 500,
            $headers
        );
    }

    /**
     * @param  \Exception $exception
     *
     * @return JsonResponse
     */
    protected function marshallResponseData(\Exception $exception)
    {
        $translator = resolve('translator');

        if ($exception instanceof ValidationException) {
            $this->collectValidationErrors($exception);

            return;
        }

        $namespace   = 'robrogers3/laravel-jsonaware-exception-handler';

        $className = get_class($exception);

        $info = collect($translator->get("$namespace::exceptionmessages.exceptions.$className"));
        
        $this->statusCode = $info->get('code', 500);

        $this->message = $info->get('message', 'Server Error: we cannot handle your request.');
        
        if ($exception instanceof MessagingException) {
            $this->setExceptionMessage($exception);
        }
    }

    /**
     * @param  \Illuminate\Validation\ValidationException $exception
     *
     * @return void
     */
    protected function collectValidationErrors(ValidationException $e)
    {
        //json doesnt need all the depths
        $this->message = array_flatten(array_values($e->validator->errors()->getMessages()));

        $this->statusCode = 422;
    }

    protected function setExceptionMessage($exception)
    {
        $this->message = $exception->getMessage() ?: $this->massage;
    }
}