<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exeption = $event->getThrowable();
        if($exeption instanceof NotFoundHttpException){
            $data = [
                'status' => $exeption->getStatusCode(),
                'message' => $exeption->getMessage()
            ];
            $event->setResponse(new Response(json_encode($data), Response::HTTP_NOT_FOUND));
        } else {
            $data = [
                'status' => 500,
                'message' => $exeption->getMessage()
            ];
            $event->setResponse(new Response(json_encode($data), Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'Kernel.exception' => 'onKernelException',
        ];
    }
}
