<?php
/**
 * EchonestArtists Facade
 */

namespace Echonest\Facade;

use Echonest\QueryBuilder;

/**
 * Class EchonestArtists
 *
 * @package Echonest\Facade
 */
class EchonestArtists extends Echonest {

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
        $this->queryBuilder->setApi('artist');
    }

    /**
     * Get Biographies
     *
     * @param string $name
     * @return $this
     */
    public function getBiographies($name)
    {
        return $this->queryBuilder
            ->setCommand('biographies')
            ->setName($name);
    }

    /**
     * Get Biographies by ID
     *
     * @param $id
     * @return $this
     */
    public function getBiographiesById($id)
    {
        return $this->queryBuilder
            ->setCommand('biographies')
            ->setId($id);
    }

    /**
     * Get Blogs
     *
     * @param string $name
     * @return $this
     */
    public function getBlogs($name)
    {
        return $this->queryBuilder
            ->setCommand('blogs')
            ->setName($name);
    }

    /**
     * Get Blogs by ID
     *
     * @param string $id
     * @return $this
     */
    public function getBlogsById($id)
    {
        return $this->queryBuilder
            ->setCommand('blogs')
            ->setId($id);
    }

    /**
     * Get Familiarity
     *
     * @param string $name
     * @return $this
     */
    public function getFamiliarity($name)
    {
        return $this->queryBuilder
            ->setCommand('familiarity')
            ->setName($name);
    }

    /**
     * Get Familiarity by ID
     *
     * @param string $id
     * @return $this
     */
    public function getFamiliarityById($id)
    {
        return $this->queryBuilder
            ->setCommand('familiarity')
            ->setId($id);
    }

    /**
     * Get artist Hotttnesss
     *
     * @param string $name
     * @return $this
     */
    public function getHotttnesss($name)
    {
        return $this->queryBuilder
            ->setCommand('hotttnesss')
            ->setName($name);
    }

    /**
     * Get Hotttnesss by ID
     *
     * @param string $id
     * @return $this
     */
    public function getHotttnesssById($id)
    {
        return $this->queryBuilder
            ->setCommand('hotttnesss')
            ->setId($id);
    }

    /**
     * Get Images
     *
     * @param string $name
     * @return $this
     */
    public function getImages($name)
    {
        return $this->queryBuilder
            ->setCommand('images')
            ->setName($name);
    }

    /**
     * Get Images by ID
     *
     * @param string $id
     * @return $this
     */
    public function getImagesById($id)
    {
        return $this->queryBuilder
            ->setCommand('images')
            ->setId($id);
    }

    /**
     * Get List of Terms
     *
     * @return $this
     */
    public function getListTerms()
    {
        return $this->queryBuilder
            ->setCommand('list_terms');
    }

    /**
     * Get News
     *
     * @param string $name
     * @return $this
     */
    public function getNews($name)
    {
        return $this->queryBuilder
            ->setCommand('news')
            ->setName($name);
    }

    /**
     * Get News by ID
     *
     * @param string $id
     * @return $this
     */
    public function getNewsById($id)
    {
        return $this->queryBuilder
            ->setCommand('news')
            ->setId($id);
    }

    /**
     * Get Profile
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
     * Get Profile by ID
     *
     * @param string $id
     * @return $this
     */
    public function getProfileById($id)
    {
        return $this->queryBuilder
            ->setCommand('profile')
            ->setId($id);
    }

    /**
     * Get Reviews
     *
     * @param string $name
     * @return $this
     */
    public function getReviews($name)
    {
        return $this->queryBuilder
            ->setCommand('reviews')
            ->setName($name);
    }

    /**
     * Get Reviews by ID
     *
     * @param string $id
     * @return $this
     */
    public function getReviewsById($id)
    {
        return $this->queryBuilder
            ->setCommand('reviews')
            ->setId($id);
    }

    /**
     * Get Search
     *
     * @return $this
     */
    public function getSearch()
    {
        return $this->queryBuilder
            ->setCommand('search');
    }

    /**
     * Get Extract (beta)
     *
     * @param string $text
     * @return $this
     */
    public function getExtract($text)
    {
        return $this->queryBuilder
            ->setCommand('extract')
            ->setOption('text', $text);
    }

    /**
     * Get Songs
     *
     * @param string $name
     * @return $this
     */
    public function getSongs($name)
    {
        return $this->queryBuilder
            ->setCommand('songs')
            ->setName($name);
    }

    /**
     * Get Songs by ID
     *
     * @param string $id
     * @return $this
     */
    public function getSongsById($id)
    {
        return $this->queryBuilder
            ->setCommand('songs')
            ->setId($id);
    }

    /**
     * Get Similar
     *
     * @param string $name
     * @return $this
     */
    public function getSimilar($name)
    {
        return $this->queryBuilder
            ->setCommand('similar')
            ->setName($name);
    }

    /**
     * Get Similar by ID
     *
     * @param string $id
     * @return $this
     */
    public function getSimilarById($id)
    {
        return $this->queryBuilder
            ->setCommand('similar')
            ->setId($id);
    }

    /**
     * Get Suggest (beta)
     *
     * @param string $name
     * @return $this
     */
    public function getSuggest($name = false)
    {
        $query = $this->queryBuilder
            ->setCommand('suggest');

        if ($name) {
            $query->setName($name);
        }

        return $query;
    }

    /**
     * Get Terms
     *
     * @param $name
     * @return $this
     */
    public function getTerms($name)
    {
        return $this->queryBuilder
            ->setCommand('terms')
            ->setName($name);
    }

    /**
     * Get Terms by ID
     *
     * @param $id
     * @return $this
     */
    public function getTermsById($id)
    {
        return $this->queryBuilder
            ->setCommand('terms')
            ->setId($id);
    }

    /**
     * Get Top Hottt
     *
     * @return $this
     */
    public function getTopHottt()
    {
        return $this->queryBuilder
            ->setCommand('top_hottt');
    }

    /**
     * Get Top Terms
     *
     * @return $this
     */
    public function getTopTerms()
    {
        return $this->queryBuilder
            ->setCommand('top_terms');
    }

    /**
     * Get Twitter
     *
     * @param string $name
     * @return $this
     */
    public function getTwitter($name)
    {
        return $this->queryBuilder
            ->setCommand('twitter')
            ->setName($name);
    }

    /**
     * Get Twitter by ID
     *
     * @param string $id
     * @return $this
     */
    public function getTwitterById($id)
    {
        return $this->queryBuilder
            ->setCommand('twitter')
            ->setId($id);
    }

    /**
     * Get Urls
     *
     * @param string $name
     * @return $this
     */
    public function getUrls($name)
    {
        return $this->queryBuilder
            ->setCommand('urls')
            ->setName($name);
    }

    /**
     * Get Urls by ID
     *
     * @param string $id
     * @return $this
     */
    public function getUrlsById($id)
    {
        return $this->queryBuilder
            ->setCommand('urls')
            ->setId($id);
    }

    /**
     * Get Video
     *
     * @param string $name
     * @return $this
     */
    public function getVideo($name)
    {
        return $this->queryBuilder
            ->setCommand('video')
            ->setName($name);
    }

    /**
     * Get Video by ID
     *
     * @param string $id
     * @return $this
     */
    public function getVideoById($id)
    {
        return $this->queryBuilder
            ->setCommand('video')
            ->setId($id);
    }
}