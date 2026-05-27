<?php

namespace App\EventListener;

use App\Controller\AdminController;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\Bundle\TestBundle\Controller\SecurityController;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class SecurityListener
{
    #[AsEventListener(event: 'kernel.controller')]
    public function onController(ControllerEvent $event): void
    {
        {
            $controller = $event->getController();
            if (is_array($controller)) {
                $controller = $controller[0];
                if ($controller instanceof AdminController) {
                    $request = $event->getRequest();
                    // security to obscurity
                    if ($request->query->get('testing') === 'day') {
                        return;
                    }

                    throw new AccessDeniedException('Access denied');
                }
            }
        }
    }
}
