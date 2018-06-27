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
use Skipper\Repository\Exceptions\EntityNotFoundException;
use Skipper\Repository\Exceptions\StorageException;

class GraphCountryRepository implements CountryRepository
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
     * @return Country
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
     * @param array $criteria
     * @throws EntityNotFoundException
     * @return Entity|Country
     */
    public function findOneBy(array $criteria): Entity
    {
        // TODO: Implement findOneBy() method.
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
        // TODO: Implement findAll() method.
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
                'in' => ['value' => $id],
            ],
        ]);
    }

    /**
     * @param int[] $ids
     * @return Entity[]
     */
    public function getAllByIds(array $ids): array
    {
        return $this->findAll([
            'filter' => [
                'id' => ['value' => $ids, 'operator' => 'in',],
            ],
        ]);
    }

    /**
     * @param array $criteria
     * @return array
     * ['data' => $data, 'total' => $count] = $repo->getAllWithTotalCount([]);
     */
    public function getAllWithTotalCount(array $criteria): array
    {
        return [];
    }
}