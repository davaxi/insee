<?php

class InformationsServiceTest extends InseePHPUnit
{
    /**
     * @var \Davaxi\Insee\Service\Informations
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        $client = new Davaxi\Insee();
        $client->setClientId($_ENV['CLIENT_ID']);
        $client->setClientSecret($_ENV['CLIENT_SECRET']);
        $client->authenticate();

        $this->service = new \Davaxi\Insee\Service\Informations($client);
    }

    public function testGetInformations()
    {
        $result = $this->service->informations();
        $this->assertInternalType('array', $result);
    }
}
