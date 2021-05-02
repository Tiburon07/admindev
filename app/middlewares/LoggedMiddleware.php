<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class LoggedMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        $response = new Response();
        $response->getBody()->write($existingContent);

        if(!isset($_SESSION['is_logged_in'])){
            return redirect($response, '/auth/login');
        }

        return $response;
    }
}