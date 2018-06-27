<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/23/18
 * Time: 3:48 PM
 */

namespace Skipper\Films\Repositories\Graph;

use GraphAware\Neo4j\Client\Client;
use Skipper\Films\Entities\Localed;
use Skipper\Films\Entities\Movie;
use Skipper\Films\Exceptions\EntityWasNotPublishedException;
use Skipper\Films\Mappers\MapperFactory;
use Skipper\Films\Repositories\MovieRepository;
use Skipper\Repository\CommonQueries;
use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\Exceptions\EntityNotFoundException;
use Skipper\Repository\Exceptions\StorageException;

class GraphMovieLocaleAwareGodRepository implements MovieRepository
{
    use Localed;
    use CommonQueries;

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
MATCH (country:Country)<-[:BELONGS_TO]-(movie:Movie{id:{id}, published:1})-[mTrans:LOCALED{locale:{locale}}]->(translate:MovieI18n)

OPTIONAL MATCH (movie)<-[rel:INVOLVED_IN]-(person:Celebrity{published:1})-[:BORN_TO]->(personCountry:Country),
               (person)-[:LOCALED{locale:{locale}}]->(personTrans:CelebrityI18n)
WHERE rel.role IN ['actor', 'writer', 'director', 'operator']

OPTIONAL MATCH (movie)<-[:PRODUCED]-(company:Producer{published:1})-[:BORN_TO]->(prodCountry:Country)

OPTIONAL MATCH (movie)-->(genre:Genre)-[:LOCALED{locale:{locale}}]->(gTranslate:GenreI18n)

WITH {
  movie:[movie, translate], 
  countries: collect(country), 
  genres: collect([genre, gTranslate]),
  cast: collect({
      person: [person, personTrans],
      role: rel.role,
      country: personCountry
  }),
  producers: collect({company: company, country:prodCountry})
} AS r

RETURN r
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
            ->toEntity($dbMovieSet['movie']);

        if (false === $movie->isPublished()) {
            throw new EntityWasNotPublishedException($movie);
        }

        return $movie;
    }

    /**
     * @param Entity|Movie $entity
     * @throws StorageException
     * @return bool
     * @throws \Skipper\Films\Exceptions\FilmException
     */
    public function save(Entity $entity): bool
    {
        $movieArray = $this->mapperFactory->getMapper(Movie::class)->toArray($entity);

        $query = <<<cypher
cypher;

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
     * @param array $criteria
     * @return array
     * ['data' => $data, 'total' => $count] = $repo->getAllWithTotalCount([]);
     */
    public function getAllWithTotalCount(array $criteria): array
    {
        return [
            'data' => $this->findAll($criteria),
            'total' => $this->count($criteria),
        ];
    }

    /**
     * @param array $criteria
     * @return int
     */
    public function count(array $criteria): int
    {
        // TODO: Implement count() method.
    }

    /**
     * @param array $criteria
     * @return bool
     */
    public function exists(array $criteria): bool
    {
        // TODO: Implement exists() method.
    }
}