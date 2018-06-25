<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/23/18
 * Time: 3:48 PM
 */

namespace Skipper\Films\Repositories;

use GraphAware\Neo4j\Client\Client;
use Skipper\Films\Entities\Localed;
use Skipper\Films\Entities\Movie;
use Skipper\Films\Exceptions\EntityWasNotPublishedException;
use Skipper\Films\Mappers\MapperFactory;
use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\Exceptions\EntityNotFoundException;
use Skipper\Repository\Exceptions\StorageException;

class GraphMovieLocaleAwareRepository implements MovieRepository
{
    use Localed;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var MapperFactory
     */
    protected $mapperFactory;

    public function __construct(string $locale, Client $client, MapperFactory $mapperFactory)
    {
        $this->client = $client;
        $this->locale = $locale;
        $this->mapperFactory = $mapperFactory;
    }


    /**
     * Get all available info for movie
     *
     * @param int $id
     * @return Movie
     * @throws EntityNotFoundException
     * @throws \Skipper\Films\Exceptions\FilmException
     */
    public function getMovie(int $id): Movie
    {
        $query = <<<cypher
MATCH (country:Country)<-[:BELONGS_TO]-(movie:Movie{id:{id}})-[mTrans:LOCALED{locale:{locale}}]->(translate:MovieI18n)

OPTIONAL MATCH (movie)<-[rel:INVOLVED_IN]-(person:Celebrity{published:1})-[cRel:BORN_TO]->(pCountry:Country)
WHERE rel.role in ['actor', 'director', 'writer', 'operator'] 

OPTIONAL MATCH (person)-[castTrans:LOCALED{locale:{locale}}]->(castTranslate:CelebrityI18n)

OPTIONAL MATCH (movie)<-[:PRODUCED]-(company:Producer{published:1})-[pRel:BORN_TO]->(prodCountry:Country)

OPTIONAL MATCH (movie)-[]->(genre:Genre)-[:LOCALED{locale:{locale}}]->(gTranslate:Country)

RETURN movie, translate, collect(person) as cast, collect(company) as producers
LIMIT 1
cypher;

        $result = $this->client->run($query, ['id' => $id, 'locale' => $this->locale]);
        try {
            $dbMovieSet = $result->firstRecord()->values();
        } catch (\RuntimeException $e) {
            throw new EntityNotFoundException(
                'Movie was not found',
                [
                    'id' => $id,
                    'locale' => $this->locale,
                ],
                $e
            );
        }

        /** @var Movie $movie */
        $movie = $this->mapperFactory
            ->getMapper(Movie::class)
            ->toEntity(array_merge($dbMovieSet['movie'], $dbMovieSet['translate']));

        if (false === $movie->isPublished()) {
            throw new EntityWasNotPublishedException($movie);
        }

        return $movie;
    }

    /**
     * @param Entity $entity
     * @throws StorageException
     * @return bool
     */
    public function save(Entity $entity): bool
    {
        // TODO: Implement save() method.
    }

    /**
     * @param Entity $entity
     * @return bool
     * @throws StorageException
     */
    public function delete(Entity $entity): bool
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param int $id
     * @return Entity
     * @throws EntityNotFoundException
     */
    public function find(int $id): Entity
    {
        return $this->findOneBy([
            'filter' => [
                'id' => ['value' => $id],
            ],
        ]);
    }

    /**
     * @param array $criteria
     * @throws EntityNotFoundException
     * @return Entity
     */
    public function findOneBy(array $criteria): Entity
    {
        // TODO: Implement findOneBy() method.
    }

    /**
     * @param int[] $ids
     * @return Entity[]
     */
    public function getAllByIds(array $ids): array
    {
        return $this->findAll([
            'filter' => [
                'id' => [
                    'operator' => 'in',
                    'value' => $ids,
                ],
            ],
        ]);
    }

    /**
     * @param array $criteria
     * @return Entity[]
     */
    public function findAll(array $criteria): array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param array $criteria
     * @return array
     * ['data' => $data, 'total' => $count] = $repo->getAllWithTotalCount([]);
     */
    public function getAllWithTotalCount(array $criteria): array
    {
        return [
            'data' => $this->findAll($criteria),
            'total' => 0,
        ];
    }
}