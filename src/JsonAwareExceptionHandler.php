<?php

namespace RobRogers3\LaravelExceptionHandler;

use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as BaseExceptionHandler;
use \Illuminate\Auth\AuthenticationException;

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

        /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response('Sorry you are Unauthenticated.', 401);
        }

        return redirect()->guest('login');
    }
}
