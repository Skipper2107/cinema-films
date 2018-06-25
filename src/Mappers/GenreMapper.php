<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/25/18
 * Time: 11:31 AM
 */

namespace Skipper\Films\Mappers;

use Skipper\Films\Entities\Genre;
use Skipper\Repository\Contracts\Entity;

class GenreMapper implements MapperInterface
{
    /**
     * @param Entity|Genre $entity
     * @return array
     */
    public function toArray(Entity $entity): array
    {
        return [
            'id' => $entity->getId(),
            'locale' => $entity->getLocale(),
            'name' => $entity->getName(),
        ];
    }

    /**
     * @param array $values
     * @return Entity|Genre
     */
    public function toEntity(array $values): Entity
    {
        $genre = new Genre($values['name']);
        $genre->setId($values['id']);
        $genre->setLocale($values['locale']);

        return $genre;
    }
}