<?php

namespace Davaxi\Insee\Service;

use Davaxi\Insee\Options;
use Davaxi\Insee\Service;

/**
 * Class Etablissement.
 *
 * @doc https://api.insee.fr/catalogue/site/themes/wso2/subthemes/insee/pages/item-info.jag?name=Sirene&version=V3&provider=insee
 */
class Etablissement extends Service
{
    /**
     * @param array|Options $options
     *
     * @return array
     */
    public function search($options = [])
    {
        if ($options instanceof Options) {
            $options = $options->getOptions();
        }

        return $this->request('GET', '/siret', $options);
    }

    /**
     * @param $siret
     * @param array|Options $options
     *
     * @return array
     */
    public function searchBySiret($siret, $options = [])
    {
        if ($options instanceof Options) {
            $options = $options->getOptions();
        }

        return $this->request('GET', '/siret/' . $siret, $options);
    }

    /**
     * @param array|Options $options
     *
     * @return array
     */
    public function searchLienDeSuccession($options = [])
    {
        if ($options instanceof Options) {
            $options = $options->getOptions();
        }

        return $this->request('GET', '/siret/liensSuccession', $options);
    }

    /**
     * @param array|Options $options
     *
     * @return array
     */
    public function searchNonDiffusibles($options = [])
    {
        if ($options instanceof Options) {
            $options = $options->getOptions();
        }

        return $this->request('GET', '/siret/nonDiffusible', $options);
    }
}
