<?php

namespace RobRogers3\LaravelExceptionHandler;

use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as BaseExceptionHandler;

class JsonAwareExceptionHandler extends BaseExceptionHandler
{
    use JsonizeResponse;
    
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return Response
     */
    public function render($request, \Exception $exception)
    {
        if ($request->wantsJson()) {
            return $this->renderJson($request, $exception);
        }
        
        return parent::render($request, $exception);
    }
}
