<?php
/**
 * Created by PhpStorm.
 * User: edwindayot
 * Date: 17/03/15
 * Time: 14:45
 */

namespace Echonest\Facade;

use Echonest\QueryBuilder;

/**
 * Class Echonest
 *
 * @package Echonest\Facade
 */
class Echonest {

    /**
     * Initialized var containing the Echonest instance
     *
     * @var bool|object
     */
    static protected $initialized = false;

    /**
     * @var string $api_key
     */
    protected $api_key, $remote;

    /**
     * Construct
     *
     * @param $api_key
     * @param $remote
     */
    protected function __construct($api_key, $remote)
    {
        $this->api_key = $api_key;
        $this->remote = $remote;
    }

    /**
     * Initialize Echonest
     *
     * @param $api_key
     * @return Echonest
     */
    static public function init(
        $api_key,
        $remote = 'http://developer.echonest.com/api/v4/'
    )
    {
        if (!self::$initialized) {
            $class = get_called_class();
            self::$initialized = new $class($api_key, $remote);
        }

        return self::$initialized;
    }
}