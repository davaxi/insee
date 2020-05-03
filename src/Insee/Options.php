<?php

namespace Davaxi\Insee;

/**
 * Class SimpleOptions.
 */
class Options
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * Contenu de la requête multicritères, voir la documentation pour plus de précisions.
     *
     * @param string $query
     *
     * @return $this
     */
    public function setQuery(string $query)
    {
        $this->options['q'] = $query;

        return $this;
    }

    /**
     * Nombre d'éléments demandés dans la réponse, défaut 20.
     *
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->options['nombre'] = $limit;

        return $this;
    }

    /**
     * Rang du premier élément demandé dans la réponse, défaut 0.
     *
     * @param int $offset
     *
     * @return $this
     */
    public function setOffset(int $offset)
    {
        $this->options['debut'] = $offset;

        return $this;
    }

    /**
     * Paramètre utilisé pour la pagination profonde, voir la documentation pour plus de précisions.
     *
     * @param string $cursor
     *
     * @return $this
     */
    public function setCursor(string $cursor)
    {
        $this->options['curseur'] = $cursor;

        return $this;
    }

    /**
     * Liste des champs demandés, séparés par des virgules.
     *
     * @param array $fields
     *
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->options['champs'] = implode(',', $fields);

        return $this;
    }

    /**
     * Date à laquelle s'appliqueront les critères de recherche sur les champs historisés, format AAAA-MM-JJ.
     *
     * @param string $date
     *
     * @return $this
     */
    public function setDate(string $date)
    {
        $this->options['date'] = $date;

        return $this;
    }

    /**
     * Affiche les attributs qui n'ont pas de valeur.
     *
     * @return $this
     */
    public function showNullValues()
    {
        $this->options['masquerValeursNulles'] = false;

        return $this;
    }

    /**
     * Masque les attributs qui n'ont pas de valeur.
     *
     * @return $this
     */
    public function hiddenNullValues()
    {
        $this->options['masquerValeursNulles'] = true;

        return $this;
    }

    /**
     * Liste des champs sur lesquels des comptages seront effectués, séparés par des virgules.
     *
     * @param array $fields
     *
     * @return $this
     */
    public function countFields(array $fields)
    {
        $this->options['facette.champ'] = implode(',', $fields);

        return $this;
    }

    /**
     * Désactive le tri des résultats par identifiants.
     *
     * @return $this
     */
    public function disableSortById()
    {
        $this->options['tri'] = false;

        return $this;
    }

    /**
     * Active le tri des résultats par identifiants.
     *
     * @return $this
     */
    public function enabledSortById()
    {
        $this->options['tri'] = true;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions() : array
    {
        return $this->options;
    }
}
