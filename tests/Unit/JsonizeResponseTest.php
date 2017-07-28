<?php

namespace Tests\Unit;

use Tests\TestCase;
use RobRogers3\LaravelExceptionHandler\JsonAwareExceptionHandler;
use Illuminate\Http\Request;
use RobRogers3\LaravelExceptionHandler\Exceptions\MessagingException;

class JsonizeResponseTest extends TestCase
{

    public $handler;

    public $request;
    
    public function setUp()
    {
        $this->handler = new JsonAwareExceptionHandler(app());

        $this->request = new Request;

        $this->request->headers->add(['accept' => 'application/json']);
        
        parent::setUp();
    }
    /**
     * @test
     */
    public function it_returns_a_json_response()
    {
        $handler = new JsonAwareExceptionHandler(app());

        $request = new Request;

        $request->headers->add(['accept' => 'application/json']);

        $response = $handler->render($request, new MessagingException('sorry charlie'));

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals('"sorry charlie"', $response->getContent());

        $this->assertEquals(418, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function it_returns_a_json_a_messsaging_response()
    {
        $response = $this->createResponse(new MessagingException('sorry charlie'));

        $this->assertEquals('"sorry charlie"', $response->getContent());

        $this->assertEquals(418, $response->getStatusCode());
    }

    /** @test */
    public function it_handles_a_authentication_exception()
    {
        $response = $this->createResponse(new \Illuminate\Auth\AuthenticationException);

        $this->assertEquals('"Sorry we dont know who you are."', $response->getContent());

        $this->assertEquals(401, $response->getStatusCode());
    }

    /** @test */
    public function it_handles_a_not_found_exception()
    {
        $response = $this->createResponse(new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException);

        $this->assertEquals('"We cannot find what you are looking for."', $response->getContent());

        $this->assertEquals(404, $response->getStatusCode());
    }
    /** @test */    
    public function it_handles_an_unknown_exception()
    {
        $response = $this->createResponse(new \Exception);

        $this->assertEquals('"Something horrible has gone awry!"', $response->getContent());

        $this->assertEquals(500, $response->getStatusCode());
    }
    
    public function createResponse($exception)
    {
       return $this->handler->render($this->request, $exception);
    }
}
