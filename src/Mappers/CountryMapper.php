<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/23/18
 * Time: 5:24 PM
 */

namespace Skipper\Films\Mappers;

use Skipper\Films\Entities\Country;
use Skipper\Repository\Contracts\Entity;

class CountryMapper implements MapperInterface
{
    /**
     * @param Entity|Country $entity
     * @return array
     */
    public function toArray(Entity $entity): array
    {
        // TODO: Implement toArray() method.
    }

    /**
     * @param array $values
     * @return Entity|Country
     */
    public function toEntity(array $values): Entity
    {
        // TODO: Implement toEntity() method.
    }
}