<?php

namespace RobRogers3\LaravelExceptionHandler;

use Exception;
use Illuminate\Translation\Translator as Lang;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait JsonizeResponse
{
    public function renderJson($request, Exception $exception)
    {
        $this->marshallResponseData($exception);
        
        return $this->prepareJsonResponse($exception);
    }
    
    protected function prepareJsonResponse(Exception $e)
    {
        $headers = $this->isHttpException($e) ? $e->getHeaders() : [];

        return JsonResponse::create(
            $this->message,
            $this->statusCode,
            $headers
        );
    }
    
    protected function marshallResponseData(\Exception $exception)
    {
        $translator = resolve('translator');

        if ($exception instanceof ValidationException) {
            $this->collectValidationErrors($exception);

            return;
        }

        $namespace   = 'robrogers3/laravel-error-handler';

        $className = get_class($exception);

        $info = collect($translator->get("$namespace::messages.exceptions.$className"));
        
        $this->statusCode = $info->get('code', 500);

        $this->message = $info->get('message', 'Server Error: we cannot handle your request');

        return $this;
    }

    protected function collectValidationErrors(ValidationException $e)
    {
        //json doesnt need all the depths
        $this->message = array_flatten(array_values($e->validator->errors()->getMessages()));

        $this->statusCode = 422;
    }
}