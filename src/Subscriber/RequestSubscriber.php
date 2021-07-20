<?php


namespace App\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class RequestSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::REQUEST => [
                ['processResponse', 10]
            ]
        ];
    }

    public function processException(RequestEvent $event)
    {
        $request = $event->getRequest();
        $requestContentType = $request->getContentType();

        $response = new JsonResponse(["Error" => $message]);
        if ($exception instanceof MissingTranslationException) {
            $response->setStatusCode(404);
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}