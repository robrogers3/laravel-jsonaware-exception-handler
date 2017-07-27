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
            'message' => 'Humm, something got lost in transmission',
        ],
        \Illuminate\Database\Eloquent\ModelNotFoundException::class => [
            'code' => 404,
            'message' => 'We cannot find what you are looking for.',
        ],
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class => [
            'code' => 404,
            'message' => 'We cannot find what you are looking for.',
        ],
        \Illuminate\Session\TokenMismatchException::class => [
            'code' => 401,
            'message' => 'Can we reconnect again?',
        ],
        \Illuminate\Validation\ValidationException::class => [
            'code' => 422,
            'message' => 'Humm, please check your form values some are invalid.'
        ],
        \RobRogers3\Exceptions\MessagingException::class => [
            'code' => 418,
            'message' => 'Humm, we have some news from your providor.'
        ],
        Exception::class => [
            'code' => 500,
            'message' => 'Something horrible has gone awry!'
        ]
    ],
    'error' => [
        '400' => [
            'name'    => 'Bad Request',
            'message' => 'The request cannot be fulfilled due to bad syntax.',
        ],
        '401' => [
            'name'    => 'Unauthorized',
            'message' => 'Authentication is required and has failed or has not yet been provided.',
        ],
        '403' => [
            'name'    => 'Forbidden',
            'message' => 'You do not have permission to perform that request.',
        ],
        '404' => [
            'name'    => 'Not Found',
            'message' => 'We Dont know whta requested resource could not be found.',
        ],
        '405' => [
            'name'    => 'Method Not Allowed',
            'message' => 'A request was made of a resource using a request method not supported by that resource.',
        ],
        '406' => [
            'name'    => 'Not Acceptable',
            'message' => 'The requested resource is only capable of generating content not acceptable.',
        ],
        '409' => [
            'name'    => 'Conflict',
            'message' => 'The request could not be processed because of a conflict in the request.',
        ],
        '410' => [
            'name'    => 'Gone',
            'message' => 'The requested resource is no longer available and will not be available again.',
        ],
        '411' => [
            'name'    => 'Length Required',
            'message' => 'The request did not specify the length of its content, which is required by the requested resource.',
        ],
        '412' => [
            'name'    => 'Precondition Failed',
            'message' => 'The server does not meet one of the preconditions that the requester put on the request.',
        ],
        '415' => [
            'name'    => 'Unsupported Media Type',
            'message' => 'The request entity has a media type which the server or resource does not support.',
        ],
        '422' => [
            'name'    => 'Unprocessable Entity',
            'message' => 'The request was well-formed but was unable to be followed due to semantic errors.',
        ],
        '428' => [
            'name'    => 'Precondition Required',
            'message' => 'The origin server requires the request to be conditional.',
        ],
        '429' => [
            'name'    => 'Too Many Requests',
            'message' => 'The user has sent too many requests in a given amount of time.',
        ],
        '500' => [
            'name'    => 'Internal Server Error',
            'message' => 'An error has occurred and this resource cannot be displayed.',
        ],
        '501' => [
            'name'    => 'Not Implemented',
            'message' => 'The server either does not recognize the request method, or it lacks the ability to fulfil the request.',
        ],
        '502' => [
            'name'    => 'Bad Gateway',
            'message' => 'The server was acting as a gateway or proxy and received an invalid response from the upstream server.',
        ],
        '503' => [
            'name'    => 'Service Unavailable',
            'message' => 'The server is currently unavailable. It may be overloaded or down for maintenance.',
        ],
        '504' => [
            'name'    => 'Gateway Timeout',
            'message' => 'The server was acting as a gateway or proxy and did not receive a timely response from the upstream server.',
        ],
        '505' => [
            'name'    => 'HTTP Version Not Supported',
            'message' => 'The server does not support the HTTP protocol version used in the request.',
        ]
    ]
];
