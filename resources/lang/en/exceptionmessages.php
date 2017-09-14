<?php
return [
    'exceptions' => [
        \Illuminate\Auth\AuthenticationException::class => [
            'code' => 401,
            'message' => 'Sorry we dont know who you are.',
        ],
        \Illuminate\Auth\Access\AuthorizationException::class => [
            'code' => 403,
            'message' => 'Sorry you are not authorized for this request.'
        ],
        \Symfony\Component\HttpKernel\Exception\HttpException::class => [
            'code' => 400,
            'message' => 'Humm, something got lost in transmission.',
        ],
        \Illuminate\Database\Eloquent\ModelNotFoundException::class => [
            'code' => 404,
            'message' => 'We cannot find what you are looking for.',
        ],
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class => [
            'code' => 404,
            'message' => 'We cannot find what you are looking for.',
        ],
        \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class => [
            'code' => 404,
            'message' => 'We really cannot find what you are looking for.'
        ],
        \Illuminate\Session\TokenMismatchException::class => [
            'code' => 451,
            'message' => 'Can we reconnect again?',
        ],
        \Illuminate\Validation\ValidationException::class => [
            'code' => 422,
            'message' => 'Humm, please check your form values some are invalid.'
        ],
        \RobRogers3\LaravelExceptionHandler\Exceptions\MessagingException::class => [
            'code' => 418,
            'message' => 'Humm, we have some news from your providor.'
        ],
        Exception::class => [
            'code' => 500,
            'message' => 'Something horrible has gone awry!'
        ]
    ]
];
