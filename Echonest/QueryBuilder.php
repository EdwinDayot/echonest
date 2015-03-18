<?php
/**
 * @copyright Edwin Dayot
 */

namespace Echonest;
use Exception;
use Guzzle\Http\Client;
use InvalidArgumentException;

/**
 * Class Echonest
 * @package Echonest
 */
class QueryBuilder
{

    /**
     * API Key for Echonest API
     *
     * @var string
     */
    private $api_key;

    /**
     * Echonest Remote
     *
     * @var string
     */
    private $remote;

    /**
     * Options
     *
     * @var array
     */
    private $options = [];

    /**
     * Query parameters
     *
     * @var string $api
     * @var string $command
     */
    private $api, $command;

    /**
     * Method for HTTP Requests
     *
     * @var string
     */
    public $method = 'get';

    /**
     * Body as XML
     *
     * @var string $body
     */
    private $body;

    /**
     * Construct to register API key and default remote
     *
     * @param string $api_key
     * @param string $remote
     */
    public function __construct($api_key, $remote)
    {
        $this->setApiKey($api_key);
        $this->setRemote($remote);
    }

    /**
     * Get API Key
     *
     * @return string
     */
    private function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * Set API Key
     *
     * @param string $api_key
     */
    private function setApiKey($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Get Remote URL for Echonest API
     *
     * @return string
     */
    private function getRemote()
    {
        return $this->remote;
    }

    /**
     * Set Remote URL for Echonest API
     *
     * @param string $remote
     */
    private function setRemote($remote)
    {
        $this->remote = $remote;
    }

    /**
     * Get Body
     *
     * @return mixed
     */
    private function getBody()
    {
        return $this->body;
    }

    /**
     * Set Body
     *
     * @param mixed $body
     */
    private function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get API category
     *
     * @return string
     */
    private function getApi()
    {
        return $this->api;
    }

    /**
     * Set API category
     *
     * @param string $api
     */
    public function setApi($api)
    {
        $this->api = $api;
        return $this;
    }

    /**
     * Get command for API category
     *
     * @return string
     */
    private function getCommand()
    {
        return $this->command;
    }

    /**
     * Set command for API category
     *
     * @param string $command
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }

    /**
     * Set an option
     *
     * @param $key
     * @param $value
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
        return $this;
    }

    /**
     * Get options for query
     *
     * @return array
     */
    private function getOptions()
    {
        return $this->options;
    }

    /**
     * Reset response data for next uses
     */
    private function resetResponse()
    {
        $this->options = [];
        $this->body = null;
        $this->command = null;
    }

    /**
     * Limit results
     *
     * @param $results
     * @param bool $start
     * @return $this
     */
    public function limit($results, $start = false)
    {
        $this->setOption('results', $results);

        if ($start != false) {
            $this->setOption('start', $start);
        }
        return $this;
    }

    /**
     * Sort By for API
     *
     * @param $key
     * @param string $order
     * @return $this
     */
    public function sortBy($key, $order = 'desc')
    {
        if ($order == 'desc' || $order == 'asc') {
            $this->setOption('sort', $key . '-' . $order);
            return $this;
        } else {
            throw new InvalidArgumentException('Order must be "asc" or "desc"');
        }
    }

    /**
     * Set Bucket
     *
     * @param array|string $name
     * @return $this
     */
    public function setBucket($name)
    {
        $this->setOption('bucket', $name);
        return $this;
    }

    /**
     * Set Name
     *
     * @param array|string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->setOption('name', $name);
        return $this;
    }

    /**
     * Set Name
     *
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->setOption('id', $id);
        return $this;
    }

    /**
     * Query builder
     *
     * @param $api
     * @param $command
     * @param array $options
     */
    private function query($api, $command, $options = [])
    {
        $client = new Client($this->getRemote());

        if (!isset($options['api_key'])) {
            $options['api_key'] = $this->getApiKey();
        }

        if ($this->method == 'get') {
            $http_query = preg_replace('/%5B[0-9]+%5D/simU', '', http_build_query($options));

            $request = $client->get($api . '/' . $command . '?' . $http_query);
        } else if ($this->method == 'post') {
            $request = $client->post($api . '/' . $command, $options);
        } else {
            throw new Exception('Wrong method for HTTP Request');
        }

        $response = $request->send();

        $this->setBody($response->getBody(true));

        return $this;
    }

    /**
     * Get
     *
     * @return string
     */
    public function get($key = null)
    {
        $response = json_decode($this->query(
            $this->getApi(),
            $this->getCommand(),
            $this->getOptions()
        )->getBody(), true)['response'];

        unset($response['status']);

        $collection = new EchonestCollection($response);

        if (!is_null($key)) {
            $collection = $collection->get($key);
        }

        $this->resetResponse();

        return $collection;
    }
}