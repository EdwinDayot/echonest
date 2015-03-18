<?php
/**
 * Created by PhpStorm.
 * User: edwindayot
 * Date: 18/03/15
 * Time: 09:24
 */

namespace Echonest;

use ArrayAccess;
use ArrayIterator;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

class EchonestCollection implements IteratorAggregate, ArrayAccess {

    /**
     * Items array
     *
     * @var array
     */
    private $items;

    /**
     * Construct
     *
     * @param array $items
     */
    public function __construct(array $response)
    {
        $this->items = $response;
    }

    /**
     * Get the key value
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        $index = explode('.', $key);
        return $this->getValue($index, $this->items);
    }

    /**
     * Get Value
     *
     * @param array $indexes
     * @param $value
     * @return EchonestCollection
     */
    private function getValue(array $indexes, $value)
    {
        $key = array_shift($indexes);
        if (empty($indexes)) {
            if (is_array($value[$key])) {
                return new EchonestCollection($value[$key]);
            } else {
                return $value[$key];
            }
        } else {
            return $this->getValue($indexes, $value[$key]);
        }
    }

    /**
     * Set a value to a key
     *
     * @param string $key
     * @param string $value
     */
    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }

    /**
     * Has key or not
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Order by key
     *
     * @param $key
     * @param string $order
     * @return EchonestCollection
     */
    public function orderBy($key, $order = 'asc')
    {
        usort($this->items, function ($a, $b) use ($key, $order)
        {
            if ($order == 'desc') {
                return $a[$key] < $b[$key];
            } else {
                return $a[$key] > $b[$key];
            }
        });
        return new EchonestCollection($this->items);
    }

    /**
     * Convert object to an array
     *
     * @return array
     */
    public function toArray()
    {
        return json_decode(json_encode($this->items), true);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        if ($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}