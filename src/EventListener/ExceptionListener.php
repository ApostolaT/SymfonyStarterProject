<?php

namespace App\EventListener;

use App\Exception\MissingTranslationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $message = sprintf(
            'Error: %s',
            $exception->getMessage()
        );

        $response = new JsonResponse(["Error" => $message]);

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof MissingTranslationException) {
            $response->setStatusCode(404);
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}