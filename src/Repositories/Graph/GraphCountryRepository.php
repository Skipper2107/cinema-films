<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/27/18
 * Time: 1:16 PM
 */

namespace Skipper\Films\Repositories\Graph;

use GraphAware\Neo4j\Client\Client;
use Skipper\Films\Entities\Country;
use Skipper\Films\Repositories\CountryRepository;
use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\CriteriaAwareRepository;
use Skipper\Repository\Exceptions\EntityNotFoundException;
use Skipper\Repository\Exceptions\StorageException;

class GraphCountryRepository extends CriteriaAwareRepository implements CountryRepository
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
     */
    public function findAll(array $criteria): array
    {
        $pagination = $this->getPaginationFromCriteria($criteria);
        $sorting = $this->getSortsFromCriteria($criteria);
        $filters = $this->getFiltersFromCriteria($criteria);
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