<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/23/18
 * Time: 4:58 PM
 */

namespace Skipper\Films\Mappers;

use Skipper\Films\Entities\Celebrity;
use Skipper\Repository\Contracts\Entity;

class CelebrityMapper implements MapperInterface
{

    /**
     * @var CountryMapper
     */
    protected $countryMapper;

    public function __construct(CountryMapper $countryMapper)
    {
        $this->countryMapper = $countryMapper;
    }

    /**
     * @param Entity|Celebrity $entity
     * @return array
     */
    public function toArray(Entity $entity): array
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'locale' => $entity->getLocale(),
            'original_name' => $entity->getOriginalName(),
            'biography' => $entity->getBiography(),
            'birth' => $entity->getBirth()->format('Y-m-d'),
            'avatar' => $entity->getAvatar(),
            'published' => $entity->isPublished(),
        ];
    }

    /**
     * @param array $values
     * @return Entity|Celebrity
     */
    public function toEntity(array $values): Entity
    {
        return new Celebrity(
            $values['name'],
            $values['original_name'],
            new \DateTime($values['birth']),
            $this->countryMapper->toEntity($values['country']),
            $values['avatar'],
            $values['biography']
        );
    }
}