<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/23/18
 * Time: 3:50 PM
 */

namespace Skipper\Films\Mappers;

use Skipper\Films\Entities\Movie;
use Skipper\Repository\Contracts\Entity;

class MovieMapper implements MapperInterface
{
    /**
     * @param Entity|Movie $entity
     * @return array
     */
    public function toArray(Entity $entity): array
    {
        return [
            'id' => $entity->getId(),
            'original_name' => $entity->getOriginalName(),
            'release_date' => $entity->getReleaseDate()->format('Y-m-d'),
            'age_restriction' => $entity->getAgeRestriction(),
            'duration' => $entity->getDuration(),
            'locale' => $entity->getLocale(),
            'name' => $entity->getName(),
            'poster' => $entity->getPoster(),
            'plot' => $entity->getPlot(),
            'trailers' => $entity->getTrailers(),
            'teaser' => $entity->getTeaser(),
            'published' => (int)$entity->isPublished(),
        ];
    }

    /**
     * @param array $values
     * @return Entity|Movie
     */
    public function toEntity(array $values): Entity
    {
        $movie = new Movie(
            $values['name'],
            $values['original_name'],
            new \DateTime($values['release_date']),
            $values['duration'],
            $values['poster']
        );

        $movie
            ->setPlot($values['plot'])
            ->setTeaser($values['teaser'])
            ->setAgeRestriction($values['age_restriction'])
            ->setTrailers($values['trailers'])
            ->setId($values['id']);
        $movie->setPublished($values['published']);
        $movie->setLocale($values['locale']);

        return $movie;
    }
}