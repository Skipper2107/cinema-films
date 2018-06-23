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
use Skipper\Films\Mappers\MovieMapper;
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
     * @var MovieMapper
     */
    protected $movieMapper;

    public function __construct(string $locale, Client $client)
    {
        $this->client = $client;
        $this->locale = $locale;
        $this->movieMapper = new MovieMapper;
    }


    /**
     * Get all available info for movie
     *
     * @param int $id
     * @return Movie
     * @throws EntityNotFoundException
     */
    public function getMovie(int $id): Movie
    {
        $query = <<<cypher
MATCH (movie:Movie{id:{id})-[:LOCALED{locale:{locale}}]->(translate:MovieI18n)
OPTIONAL MATCH (movie:Movie{id:{id})<-[rel:CREATED]-(person:Celebrity) 
WHERE rel.role ['actor', 'director', 'writer', 'operator'] 
OPTIONAL MATCH (movie:Movie{id:{id})<-[:PRODUCED]-(company:Producer)
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

        $movie = $this->movieMapper->toEntity(array_merge($dbMovieSet['movie'], $dbMovieSet['translate']));

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
        // TODO: Implement find() method.
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
     * @param array $criteria
     * @return Entity[]
     */
    public function findAll(array $criteria): array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param int[] $ids
     * @return Entity[]
     */
    public function getAllByIds(array $ids): array
    {
        // TODO: Implement getAllByIds() method.
    }

    /**
     * @param array $criteria
     * @return array
     * ['data' => $data, 'total' => $count] = $repo->getAllWithTotalCount([]);
     */
    public function getAllWithTotalCount(array $criteria): array
    {
        // TODO: Implement getAllWithTotalCount() method.
    }
}