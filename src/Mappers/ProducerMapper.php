<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/25/18
 * Time: 11:33 AM
 */

namespace Skipper\Films\Mappers;

use Skipper\Films\Entities\Country;
use Skipper\Films\Entities\Producer;
use Skipper\Repository\Contracts\Entity;

class ProducerMapper implements MapperInterface
{

    /**
     * @var MapperInterface
     */
    protected $countryMapper;

    public function __construct(MapperInterface $countryMapper)
    {
        $this->countryMapper = $countryMapper;
    }

    /**
     * @param Entity|Producer $entity
     * @return array
     */
    public function toArray(Entity $entity): array
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'published' => $entity->isPublished(),
        ];
    }

    /**
     * @param array $values
     * @return Entity|Producer
     */
    public function toEntity(array $values): Entity
    {
        /** @var Country $country */
        $country = $this->countryMapper->toEntity($values['country']);
        $producer = new Producer(
            $values['name'],
            $country
        );

        $producer->setId($values['id']);
        $producer->setPublished($values['published']);

        return $producer;
    }
}