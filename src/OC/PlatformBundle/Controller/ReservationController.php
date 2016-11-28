<?php


namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Reservation;
use OC\PlatformBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends controller
{
    public function choiceAction(Request $request)
    {
        $reservation = new Reservation();
        $reservation->setDate(new \Datetime());

        $form   = $this->get('form.factory')->create(ReservationType::class, $reservation);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            return $this->redirectToRoute('oc_platform_paiement');
        }

        return $this->render('OCPlatformBundle:Reservation:choice.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function paiementAction ()
    {
        $content = $this->get('templating')->render('OCPlatformBundle:Reservation:paiement.html.twig');

        return new Response($content);

    }

    public function confirmationAction ()
    {
        $content = $this->get('templating')->render('OCPlatformBundle:Reservation:confirmation.html.twig');

        return new Response($content);

    }
}