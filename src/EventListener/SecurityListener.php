<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class SecurityListener
{
    #[AsEventListener(event: RequestEvent::class, priority: 0)]
    public function onKernelRequest(RequestEvent $event) : void {

        $route = $event->getRequest()->attributes->get('_route');
        // guard
        if (!str_contains($route, 'admin')) {
            return;
        }

        $auth = $this->getAuthHeader($event->getRequest());
        if (count($auth) === 2 && $auth[0] === 'testing' && $auth[1] === 'day') {
            // pass
            return;
        }

        $response = new Response();
        $response->headers->set('WWW-Authenticate', \sprintf('Basic realm="%s"', 'Admin Area'));
        $response->setStatusCode(401);
        $event->setResponse($response);
    }

   protected function getAuthHeader(Request $request) : array {
        $header = $request->headers->get('Authorization');
        if (empty($header)) {
            return [];
        }

        // parse the basic auth header
        if (str_starts_with($header, 'Basic ')) {
            $header = substr($header, 6);
            $header = base64_decode($header);
        } else {
            return [];
        }
        return explode(':', $header);
   }
}
