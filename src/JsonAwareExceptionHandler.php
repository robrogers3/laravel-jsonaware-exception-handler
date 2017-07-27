<?php

namespace RobRogers3\LaravelExceptionHandler;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Translation\Translator as Lang;
use Illuminate\Foundation\Exceptions\Handler as BaseExceptionHandler;

class JsonAwareExceptionHandler extends BaseExceptionHandler
{
    use JsonizeResponse;
    
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            return $this->renderJson($request, $exception);
        }
        
        return parent::render($request, $exception);
    }
}
