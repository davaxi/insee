<?php

use Davaxi\Insee as Insee;

class InseeTest extends InseePHPUnit
{
    /**
     * @var Insee
     */
    protected $insee;

    protected function setUp()
    {
        parent::setUp();
        $this->insee = new Insee();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->insee = null;
    }

    public function testClass()
    {
        $this->assertTrue(true);
    }

    public function testAuthenticate_withoutClientIdSecret()
    {
        $this->expectException("Exception");
        $this->expectExceptionMessage("Missing client Id");
        $this->insee->authenticate();
    }

    public function testAuthenticate_withoutClientId()
    {
        $this->expectException("Exception");
        $this->expectExceptionMessage("Missing client Id");
        $this->insee->setClientSecret('CLIENT_SECRET');
        $this->insee->authenticate();
    }

    public function testAuthenticate_withoutClientSecret()
    {
        $this->expectException("Exception");
        $this->expectExceptionMessage("Missing client secret");
        $this->insee->setClientId('CLIENT_ID');
        $this->insee->authenticate();
    }

    public function testAuthenticate_withInvalidOauth()
    {
        $this->expectException("GuzzleHttp\Exception\ClientException");
        $this->insee->setClientId('invalid_client_id');
        $this->insee->setClientSecret('invalid_client_secret');
        $this->insee->authenticate();
    }

    public function testAuthenticate()
    {
        $this->insee->setClientId($_ENV['CLIENT_ID']);
        $this->insee->setClientSecret($_ENV['CLIENT_SECRET']);
        $this->insee->authenticate(10);

        $accessToken = $this->insee->getAccessToken();
        $this->assertInternalType('array', $accessToken);
        $this->assertArrayHasKey('access_token', $accessToken);
        $this->assertNotNull($accessToken['access_token']);
        $this->assertArrayHasKey('scope', $accessToken);
        $this->assertNotNull($accessToken['scope']);
        $this->assertArrayHasKey('token_type', $accessToken);
        $this->assertEquals('Bearer', $accessToken['token_type']);
        $this->assertArrayHasKey('expires_in', $accessToken);
    }

    public function testRevokeAccessToken_withoutClientIdSecret()
    {
        $this->expectException("Exception");
        $this->expectExceptionMessage("Missing client Id");
        $this->insee->revokeAccessToken();
    }

    public function testRevokeAccessToken_withoutClientId()
    {
        $this->expectException("Exception");
        $this->expectExceptionMessage("Missing client Id");
        $this->insee->setClientSecret('CLIENT_SECRET');
        $this->insee->revokeAccessToken();
    }

    public function testRevokeAccessToken_withoutClientSecret()
    {
        $this->expectException("Exception");
        $this->expectExceptionMessage("Missing client secret");
        $this->insee->setClientId('CLIENT_ID');
        $this->insee->revokeAccessToken();
    }

    public function testRevokeAccessToken_withoutAccessToken()
    {
        $this->expectException("Exception");
        $this->expectExceptionMessage("Missing access token");
        $this->insee->setClientId('invalid_client_id');
        $this->insee->setClientSecret('invalid_client_secret');
        $this->insee->revokeAccessToken();
    }

    public function testRevoke()
    {
        $this->insee->setClientId($_ENV['CLIENT_ID']);
        $this->insee->setClientSecret($_ENV['CLIENT_SECRET']);
        $this->insee->authenticate(10);

        $accessToken = $this->insee->getAccessToken();
        $this->assertInternalType('array', $accessToken);

        $this->insee->revokeAccessToken();
        $accessToken = $this->insee->getAccessToken();
        $this->assertEmpty($accessToken);
    }
}
