<?php

namespace Tests\OC\PlatformBundle\Url;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/fr/'),
            array('/fr/billetterie'),
            array('/fr/paiement'),
            array('/fr/confirmation'),
            array('/en/'),
            array('/en/billetterie'),
            array('/en/paiement'),
            array('/en/confirmation'),
        );
    }
}