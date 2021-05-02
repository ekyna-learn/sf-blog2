<?php

namespace App\Repository;

/**
 * Class AbstractRepository
 * @package App\Repository
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractRepository
{
    /**
     * @var array
     */
    private static $data;

    /**
     * @var array
     */
    private $cache;


    /**
     * Initializes the data.
     */
    private static function initialize()
    {
        if (!is_null(self::$data)) {
            return;
        }

        self::$data = require_once __DIR__ . '/../Resources/data.php';
    }

    /**
     * Returns the object data for the given index and id.
     *
     * @param string $type
     *
     * @return array
     */
    protected function getObjectData(string $type)
    {
        self::initialize();

        if (!isset(self::$data[$type])) {
            throw new \UnexpectedValueException("Undefined object type '$type'.");
        }

        return self::$data[$type];
    }

    /**
     * Returns the object data for the given index and id.
     *
     * @param string $type
     * @param int    $id
     *
     * @return array
     */
    protected function getObjectDataById(string $type, int $id)
    {
        self::initialize();

        if (!isset(self::$data[$type])) {
            throw new \UnexpectedValueException("Undefined object type '$type'.");
        }

        if (isset(self::$data[$type][$id])) {
            return self::$data[$type][$id];
        }

        throw new \UnexpectedValueException("Undefined data index '$id'.");
    }

    /**
     * Returns the object data for the given index and id.
     *
     * @param string $type
     * @param string $key
     * @param string $value
     * @param bool   $single
     *
     * @return array
     */
    protected function getObjectDataByKeyValue(string $type, string $key, $value, bool $single = true)
    {
        self::initialize();

        if (!isset(self::$data[$type])) {
            throw new \UnexpectedValueException("Undefined object type '$type'.");
        }

        $test = reset(self::$data[$type]);
        if (!isset($test[$key])) {
            throw new \UnexpectedValueException("Object of type '$type' has no key '$key'.");
        }

        $collection = [];

        foreach (self::$data[$type] as $datum) {
            if ($datum[$key] === $value) {
                if ($single) {
                    return $datum;
                }

                $collection[] = $datum;
            }
        }

        if ($single) {
            throw new \UnexpectedValueException("Object of type '$type' not found for key '$key' and value '$value'.");
        }

        return $collection;
    }

    /**
     * Returns whether an object is cached for the given id.
     *
     * @param int $id
     *
     * @return bool
     */
    protected function has(int $id)
    {
        return isset($this->cache[$id]);
    }

    /**
     * Returns the cached object for the given id.
     *
     * @param int $id
     *
     * @return object
     */
    protected function get(int $id)
    {
        if (!$this->has($id)) {
            throw new \UnexpectedValueException("Undefined cache entry $id.");
        }

        return $this->cache[$id];
    }

    /**
     * cached the given object.
     *
     * @param int    $id
     * @param object $object
     */
    protected function set(int $id, $object)
    {
        $this->cache[$id] = $object;
    }
}
