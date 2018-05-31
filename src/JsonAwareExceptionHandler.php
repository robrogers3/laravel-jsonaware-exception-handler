<?php

namespace RobRogers3\LaravelExceptionHandler;

use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as BaseExceptionHandler;
use \Illuminate\Auth\AuthenticationException;

class JsonAwareExceptionHandler extends BaseExceptionHandler
{
    use JsonizeResponse;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

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
