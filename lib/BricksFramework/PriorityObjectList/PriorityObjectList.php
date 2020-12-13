<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/

declare(strict_types=1);

namespace BricksFramework\PriorityObjectList;

use BricksFramework\PriorityArrayList\PriorityArrayList;

class PriorityObjectList extends PriorityArrayList implements PriorityObjectListInterface
{
    protected $noObjectDuplicates = true;

    /**
     * @var string
     */
    protected $objectInterface = null;

    public function __construct(string $objectInterface = null)
    {
        if (null !== $objectInterface) {
            $this->setObjectInterface($objectInterface);
        }
    }

    public function setNoObjectDuplicates(bool $bool) : void
    {
        $this->noObjectDuplicates = $bool;
    }

    public function getNoObjectDuplicates() : bool
    {
        return $this->noObjectDuplicates;
    }

    public function setObjectInterface(string $interface) : void
    {
        $this->objectInterface = $interface;
    }

    public function getObjectInterface() : string
    {
        return $this->objectInterface ? : '';
    }

    public function isValidObject(object $object) : bool
    {
        $interface = $this->getObjectInterface();
        return ($object instanceof $interface);
    }

    /**
     * @throws Exception\InvalidObjectInterfaceException
     */
    protected function validateObject(object $object) : void
    {
        if(!$this->isValidObject($object)) {
            throw new Exception\InvalidObjectInterfaceException();
        }
    }

    /**
     * @throws Exception\InvalidObjectInterfaceException
     * @throws Exception\KeyExistsException
     * @throws Exception\ObjectExistsException
     */
    public function add(string $key, $object, int $priority = 0) : void
    {
        $this->validateObject($object);

        if ($this->getNoObjectDuplicates() && $this->containsObject($object)) {
            throw new Exception\ObjectExistsException('This object has already been added and no duplicates are allowed, please use ::set()');
        }

        parent::add($key, $object, $priority);
    }


    /**
     * @throws Exception\InvalidObjectInterfaceException
     */
    public function set(string $key, $object, int $priority = 0) : void
    {
        $this->validateObject($object);
        parent::set($key, $object, $priority);
    }

    public function containsObject(object $object) : bool
    {
        return false !== array_search($object, $this->data);
    }
}
