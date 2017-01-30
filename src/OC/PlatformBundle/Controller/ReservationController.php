<?php


namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Reservation;
use OC\PlatformBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class ReservationController extends controller
{
    public function indexAction()
    {
        return $this->render('OCPlatformBundle:Reservation:index.html.twig');
    }

    /**
     * @Route("/", name="oc_platform_choice", schemes={"%secure_channel%"})
     */
    public function choiceAction(Request $request)
    {

        $reservation = new Reservation();

        $form = $this->get('form.factory')->create(ReservationType::class, $reservation);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $setPrice = $this->get('set_price');
            $setPrice->choicePaiement($reservation);

            return $this->redirectToRoute('oc_platform_paiement');
        }

        return $this->render('OCPlatformBundle:Reservation:choice.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function paiementAction(Request $request)
    {
        $error = false;

        if ($request->isMethod('POST')) {

            try {
                $stripePaiement = $this->get('stripe_paiement');
                $stripePaiement->chargePaiement($request);
            }
            catch (\Stripe\Error\Card $e) {
                    $error = 'Un problème lors du paiment est survenu :'.$e->getMessage();
            }

            if (!$error) {
                return $this->redirectToRoute('oc_platform_confirmation');
            }
        }

        return $this->render('OCPlatformBundle:Reservation:paiement.html.twig', array(
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
            'error' => $error
        ));

    }

    public function confirmationAction(Request $request)
    {
        $session = $request->getSession();
        $visitors = $session->get('visitors');
        $price = $session->get('price');

        return $this->render('OCPlatformBundle:Reservation:confirmation.html.twig', array(
            'visitors' => $visitors,
            'price' => $price
        ));

    }
}