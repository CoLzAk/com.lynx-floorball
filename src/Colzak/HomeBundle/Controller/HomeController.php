<?php

namespace Colzak\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\HomeBundle\Document\Message;
use Colzak\HomeBundle\Form\Type\ContactFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Colzak\NotificationBundle\Document\Notification;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakHomeBundle:Home:index.html.twig');
    }

    public function contactAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $message = new Message();
        $form = $this->get('form.factory')->create(new ContactFormType(), $message);

        $request = $this->getRequest();

        if($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $message = $form->getData();
                $dm->persist($message);
                $dm->flush();

                //Notify admin about that (transform notif)
                $senderEmail = $message->getFrom();
                $recipientEmail = 'joel.lauret@gmail.com';
                $notification = new Notification();
                $notification->setStatus(Notification::STATUS_PENDING);
                $notification->setFrom($senderEmail);
                $notification->setFromName($senderEmail);
                $notification->setTo($recipientEmail);
                $notification->setSubject($message->getSubject());
                $notification->setContent($message->getBody());
                $dm->persist($notification);
                $dm->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Votre message à bien été envoyé ! Vous recevrez une réponse dans les plus bref délais.'
                );
                return new RedirectResponse($this->container->get('router')->generate('colzak_home_contact'));
            }
        }

        return $this->render('ColzakHomeBundle:Home:contact.html.twig', array('form' => $form->createView()));
    }
}
