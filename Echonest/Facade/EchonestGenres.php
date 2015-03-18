<?php
/**
 * EchonestTracks Facade
 */

namespace Echonest\Facade;

use Echonest\QueryBuilder;

/**
 * Class EchonestSongs
 *
 * @package Echonest\Facade
 */
class EchonestGenres extends Echonest {

    /**
     * Query Builder
     *
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * Construct
     *
     * @param string $api_key
     * @param string $remote
     */
    public function __construct(Echonest $echonest)
    {
        $this->queryBuilder = new QueryBuilder($echonest->api_key, $echonest->remote);
        $this->queryBuilder->setApi('genre');
    }

    /**
     * Get Artists by genre name
     *
     * @param string $name
     * @return $this
     */
    public function getArtists($name)
    {
        return $this->queryBuilder
            ->setCommand('artists')
            ->setName($name);
    }

    /**
     * Get list of genres
     *
     * @return $this
     */
    public function getList()
    {
        return $this->queryBuilder
            ->setCommand('list');
    }

    /**
     * Get Profile of genre
     *
     * @param string $name
     * @return $this
     */
    public function getProfile($name)
    {
        return $this->queryBuilder
            ->setCommand('profile')
            ->setName($name);
    }

    /**
     * Search Genre (by name)
     *
     * @return $this
     */
    public function getSearch($name = false)
    {
        $query = $this->queryBuilder
            ->setCommand('search');

        if ($name) {
            $query->setName($name);
        }

        return $query;
    }

    /**
     * Get Similar (by name)
     *
     * @param string $name
     * @return $this
     */
    public function getSimilar($name = false)
    {
        $query = $this->queryBuilder
            ->setCommand('similar');

        if ($name) {
            $query->setName($name);
        }

        return $query;
    }
}