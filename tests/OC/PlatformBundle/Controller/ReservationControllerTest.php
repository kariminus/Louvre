<?php

namespace tests\OC\PlatformBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends WebTestCase
{
    public function testReservationForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/billetterie');

        $form = $crawler->selectButton('reservation_save')->form();

        $form['reservation[date]']      = "11/12/2016";
        $form['reservation[dayTime]']    = false;



        $crawler = $client->submit($form);


    }
}