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
class EchonestTracks extends Echonest {

    /**
     * Query Builder
     *
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * Construct
     *
     * @param $api_key
     * @param $remote
     */
    public function __construct(Echonest $echonest)
    {
        $this->queryBuilder = new QueryBuilder($echonest->api_key, $echonest->remote);
        $this->queryBuilder->setApi('track');
    }

    /**
     * Get Track
     *
     * @param $id
     * @return $this
     */
    public function getTrackProfile($id)
    {
        return $this->queryBuilder
            ->setCommand('profile')
            ->setOption('id', $id);
    }

    /**
     * Get Upload Track
     *
     * @param $url
     * @return $this
     */
    public function getUploadTrack($url)
    {
        return $this->queryBuilder
            ->setCommand('upload')
            ->setOption('url', $url);
    }

    /**
     * Post Upload Track ()
     *
     * @param $url
     * @return $this
     */
    public function postUploadTrack($url)
    {
        $this->queryBuilder->method = 'post';
        return $this->queryBuilder
            ->setCommand('upload')
            ->setOption('url', $url);
    }
}