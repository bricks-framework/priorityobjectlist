<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/

namespace BricksFramework\PriorityObjectList;

interface PriorityObjectListInterface
{
    public function setNoObjectDuplicates(bool $bool) : void;

    public function getNoObjectDuplicates() : bool;

    public function setObjectInterface(string $interface) : void;

    public function getObjectInterface() : string;

    public function isValidObject(object $object) : bool;

    public function containsObject(object $object) : bool;
}
