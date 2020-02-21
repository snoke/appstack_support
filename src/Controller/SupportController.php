<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SupportFormType;

class SupportController extends AbstractController
{
    /**
     * @Route("/", name="support")
     */
    public function index( \Swift_Mailer $mailer,Request $request )
    {
		$sent = false;
		$form = $this->createForm(SupportFormType::class,null,['method' => 'POST']);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData(); 
			$message = (new \Swift_Message('Support Mail'))
				->setFrom($_ENV['MAIL_FROM'])
				->setTo($_ENV['MAIL_TO'])
				->setBody(
					$data["name"] . '<' . $data["email"] . '> wrote: ' . $data["subject"] . "\n\r" . $data["message"] ,
					'text/plain'
				)
			;
			$mailer->send($message);
			return $this->render('support/sent.html.twig', []);
		}
        return $this->render('support/index.html.twig', [
			'form' => $form->createView(),
        ]);
    }
}
