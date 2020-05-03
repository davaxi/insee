<?php

namespace Davaxi;

use GuzzleHttp\Client;

/**
 * Class Insee.
 */
class Insee
{
    const INSEE_API_DOMAIN = 'https://api.insee.fr';
    // 7 days
    const DEFAULT_VALIDITY_PERIOD = 604800;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var array
     */
    protected $accessToken;

    /**
     * Insee constructor.
     *
     * @param null $client
     */
    public function __construct($client = null)
    {
        if (!$client) {
            $client = new Client();
        }
        $this->client = $client;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * Use Help of INSEE
     * https://api.insee.fr/catalogue/site/themes/wso2/subthemes/insee/pages/help.jag.
     *
     * @param int $validityPeriod
     *
     * @throws \Exception
     */
    public function authenticate($validityPeriod = null)
    {
        $this->checkClientOauth();
        if (!$validityPeriod) {
            $validityPeriod = static::DEFAULT_VALIDITY_PERIOD;
        }
        $result = $this->client->request(
            'POST',
            static::INSEE_API_DOMAIN . '/token',
            [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'validity_period' => $validityPeriod,
                ],
                'headers' => [
                    'Authorization' => $this->getAuthorizationHeader(),
                ],
            ]
        );

        $accessToken = json_decode($result->getBody(), true);
        $this->setAccessToken($accessToken);
    }

    /**
     * @doc https://api.insee.fr/catalogue/site/themes/wso2/subthemes/insee/pages/help.jag
     *
     * @param array $accessToken
     *
     * @throws \Exception
     */
    public function revokeAccessToken()
    {
        $this->checkClientOauth();
        $this->checkAccessToken();

        $result = $this->client->request(
            'POST',
            static::INSEE_API_DOMAIN . '/revoke',
            [
                'form_params' => [
                    'token' => $this->getAccessTokenValue(),
                ],
                'headers' => [
                    'Authorization' => $this->getAuthorizationHeader(),
                ],
            ]
        );
        $this->accessToken = null;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array  $data
     *
     * @return array
     */
    public function request(string $method, string $path, array $data)
    {
        $this->checkAccessToken();

        $result = $this->client->request(
            $method,
            static::INSEE_API_DOMAIN . $path,
            [
                'form_params' => $data,
                'headers' => [
                    'Authorization' => $this->getAuthorizationHeaderByAccessToken(),
                ],
            ]
        );

        return json_decode($result->getBody(), true);
    }

    /**
     * @return string
     */
    public function getAuthorizationHeaderByAccessToken() : string
    {
        return sprintf('Bearer %s', $this->getAccessTokenValue());
    }

    /**
     * @return string
     */
    public function getAuthorizationHeader() : string
    {
        return sprintf(
            'Basic %s',
            base64_encode(
                sprintf(
                    '%s:%s',
                    $this->clientId,
                    $this->clientSecret
                )
            )
        );
    }

    /**
     * @param array $accessToken
     */
    public function setAccessToken(array $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return array
     */
    public function getAccessToken() : array
    {
        return $this->accessToken ?? [];
    }

    public function getAccessTokenValue() : string
    {
        $accessToken = $this->getAccessToken();

        return $accessToken ? $accessToken['access_token'] : '';
    }

    protected function checkAccessToken()
    {
        if (!$this->getAccessTokenValue()) {
            throw new \LogicException('Missing access token');
        }
    }

    /**
     * @throws \Exception
     */
    protected function checkClientOauth()
    {
        if (!$this->clientId) {
            throw new \Exception('Missing client Id');
        }
        if (!$this->clientSecret) {
            throw new \Exception('Missing client secret');
        }
    }
}
