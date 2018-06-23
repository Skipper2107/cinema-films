<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/23/18
 * Time: 3:50 PM
 */

namespace Skipper\Films\Mappers;

use Skipper\Repository\Contracts\Entity;

interface MapperInterface
{
    /**
     * @param Entity $entity
     * @return array
     */
    public function toArray(Entity $entity): array;

    /**
     * @param array $values
     * @return Entity
     */
    public function toEntity(array $values): Entity;
}