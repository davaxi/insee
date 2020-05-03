<?php

namespace Davaxi\Insee;

use Davaxi\Insee;

/**
 * Class Service.
 */
abstract class Service
{
    const BASE_PATH = '/entreprises/sirene/V3';

    /**
     * @var Insee
     */
    protected $client;

    /**
     * Sirene constructor.
     *
     * @param Insee $client
     */
    public function __construct(Insee $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return array
     */
    protected function getRequest(string$path, array $options)
    {
        return $this->client->getRequest(static::BASE_PATH . $path, $options);
    }
}
