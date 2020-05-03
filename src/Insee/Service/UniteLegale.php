<?php

namespace Davaxi\Insee\Service;

use Davaxi\Insee\Service;
use Davaxi\Insee\Options;

/**
 * Class UniteLegale.
 *
 * @doc https://api.insee.fr/catalogue/site/themes/wso2/subthemes/insee/pages/item-info.jag?name=Sirene&version=V3&provider=insee
 */
class UniteLegale extends Service
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

        return $this->request('GET', '/siren', $options);
    }

    /**
     * @param $siren
     * @param array|Options $options
     *
     * @return array
     */
    public function searchBySiren($siren, $options = [])
    {
        if ($options instanceof Options) {
            $options = $options->getOptions();
        }

        return $this->request('GET', '/siren/' . $siren, $options);
    }

    /**
     * @param array|Options $options
     *
     * @return array
     */
    public function searchNonDifusibles($options = [])
    {
        if ($options instanceof Options) {
            $options = $options->getOptions();
        }

        return $this->request('GET', '/siren/nonDiffusibles', $options);
    }

    /**
     * @param array|Options $options
     *
     * @return array
     */
    public function searchRefusImmatriculationRcs($options = [])
    {
        if ($options instanceof Options) {
            $options = $options->getOptions();
        }

        return $this->request('GET', '/siren/refusImmatriculationRcs', $options);
    }
}
