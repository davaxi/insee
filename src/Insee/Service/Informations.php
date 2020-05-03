<?php

namespace Davaxi\Insee\Service;

use Davaxi\Insee\Service;

/**
 * Class Informations.
 *
 * @doc https://api.insee.fr/catalogue/site/themes/wso2/subthemes/insee/pages/item-info.jag?name=Sirene&version=V3&provider=insee
 */
class Informations extends Service
{
    /**
     * @return array
     */
    public function informations()
    {
        return $this->getRequest('/informations', []);
    }
}
