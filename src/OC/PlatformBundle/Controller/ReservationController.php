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
        $session = $request->getSession();

        $reservation = new Reservation();

        $form = $this->get('form.factory')->create(ReservationType::class, $reservation);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $session->set('price',      $reservation->getPrice());
            $session->set('visitors',   $reservation->getVisitors());

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            //$em->flush();
            return $this->redirectToRoute('oc_platform_paiement');
        }

        return $this->render('OCPlatformBundle:Reservation:choice.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function paiementAction (Request $request)
    {
        $session = $request->getSession();
        $date = $session->get('date');
        $price = $session->get('price');

        if ($request->isMethod('POST')) {
            $token = $request->request->get('stripeToken');
            \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));
            \Stripe\Charge::create(array(
                "amount" => $price * 100,
                "currency" => "eur",
                "source" => $token,
                "description" => "First test charge!"
            ));
            $this->addFlash('success', 'Order Complete! Yay!');
            return $this->redirectToRoute('oc_platform_confirmation');
        }

        return $this->render('OCPlatformBundle:Reservation:paiement.html.twig', array(
            'stripe_public_key' => $this->getParameter('stripe_public_key')
        ));

    }

    public function confirmationAction (Request $request)
    {
        $session = $request->getSession();
        $visitors = $session->get('visitors');
        $content = $this->get('templating')->render('OCPlatformBundle:Reservation:confirmation.html.twig');

        return new Response($content);

    }
}