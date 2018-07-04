<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/27/18
 * Time: 1:16 PM
 */

namespace Skipper\Films\Repositories\Graph;

use GraphAware\Neo4j\Client\Client;
use GraphAware\Neo4j\Client\Exception\Neo4jException;
use Skipper\Exceptions\HttpCode;
use Skipper\Films\Entities\Country;
use Skipper\Films\Mappers\MapperFactory;
use Skipper\Films\Repositories\CountryRepository;
use Skipper\Films\Repositories\CypherHelper;
use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\CriteriaAwareRepository;
use Skipper\Repository\Exceptions\EntityNotFoundException;
use Skipper\Repository\Exceptions\StorageException;

class GraphCountryRepository extends CriteriaAwareRepository implements CountryRepository
{
    use CypherHelper;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var MapperFactory
     */
    protected $mappers;

    public function __construct(Client $client, MapperFactory $mappers)
    {
        $this->client = $client;
        $this->mappers = $mappers;
    }

    /**
     * @param string $code
     * @return Country|Entity
     * @throws EntityNotFoundException
     */
    public function findByCode(string $code): Country
    {
        return $this->findOneBy([
            'filter' => [
                'code' => ['value' => $code],
            ],
        ]);
    }

    /**
     * @param string[] $codes
     * @return Country[]
     * @throws StorageException
     * @throws \Skipper\Films\Exceptions\FilmException
     */
    public function findAllByCodes(array $codes): array
    {
        return $this->findAll([
            'filter' => [
                'code' => ['value' => $codes, 'operator' => 'in',],
            ],
        ]);
    }

    /**
     * @param array $criteria
     * @return Entity[]
     * @throws StorageException
     * @throws \Skipper\Films\Exceptions\FilmException
     */
    public function findAll(array $criteria): array
    {
        $pagination = $this->getPaginationFromCriteria($criteria);
        $sorting = $this->getSortsFromCriteria($criteria);
        $filters = $this->getFiltersFromCriteria($criteria);

        $query = sprintf(
            'MATCH (c:Country) %s RETURN collect(c) %s SKIP %d LIMIT %d',
            $this->applyFilters('c', $filters),
            $this->applyOrders('c', $sorting),
            $pagination->getOffset(),
            $pagination->getLimit()
        );

        try {
            $result = $this->client->run($query)->records();
        } catch (Neo4jException $e) {
            throw new StorageException(HttpCode::fromCode($e->getCode()), $e->getMessage(), [
                'criteria' => $criteria,
            ], $e);
        }

        $mapper = $this->mappers->getMapper(Country::class);
        foreach ($result as $record) {
            $countries[] = $mapper->toEntity($record->values());
        }

        return $countries ?? [];
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
     * @param array $criteria
     * @return array
     * ['data' => $data, 'total' => $count] = $repo->getAllWithTotalCount([]);
     * @throws StorageException
     * @throws \Skipper\Films\Exceptions\FilmException
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
     * @throws StorageException
     */
    public function count(array $criteria): int
    {
        $filters = $this->getFiltersFromCriteria($criteria);

        $query = sprintf(
            'MATCH (c:Country) %s RETURN count(*) as count',
            $this->applyFilters('c', $filters)
        );

        try {
            $result = $this->client->run($query)->firstRecord();
        } catch (Neo4jException $e) {
            throw new StorageException(HttpCode::fromCode($e->getCode()), $e->getMessage(), [
                'criteria' => $criteria,
            ], $e);
        }

        return $result->get('count');
    }

    /**
     * @param array $criteria
     * @return bool
     * @throws StorageException
     */
    public function exists(array $criteria): bool
    {
        return $this->count($criteria) > 0;
    }
}