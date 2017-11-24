<?php

namespace AppBundle\Controller;

use AppBundle\Form\ContactType;
use Doctrine\ORM\Mapping as Embedded;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function indexAction(\Swift_Mailer $mailer)
    {
        // replace this example code with whatever you need
        return $this->redirectToRoute("article_index");
    }

    /**
     * @Route("/contact", name="contact")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param \Twig_Environment $twig
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request, \Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject($form->get("object")->getData())
                ->setFrom($form->get("mail")->getData())
                ->setTo("mail@mail.com")
                ->setBody(
                    $twig->loadTemplate(
                        "default/email.html.twig"
                    )->render([
                        "form" => $form
                    ]),
                    "text/html"
                );
            $mailer->send($message);

            $this->addFlash("success", "Email sent !");
        }

        return $this->render("default/contact.html.twig",
            ["form" => $form->createView()]
        );
    }
}
