<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 1:15 PM
 */

namespace Skipper\Films\Services;

use Skipper\Films\Entities\Producer;
use Skipper\Films\Repositories\CountryRepository;
use Skipper\Films\Repositories\ProducerRepository;
use Skipper\Films\Requests\ProducerRequest;

class ProducersCrudService
{
    /**
     * @var ProducerRepository
     */
    protected $producers;

    /**
     * @var CountryRepository
     */
    protected $countries;

    public function __construct(ProducerRepository $producers, CountryRepository $countries)
    {
        $this->producers = $producers;
        $this->countries = $countries;
    }

    /**
     * @param ProducerRequest $request
     * @return Producer
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function toggle(ProducerRequest $request): Producer
    {
        /** @var Producer $producer */
        $producer = $this->producers->find($request->getId());

        $producer->setPublished($request->getPublished());

        $this->producers->save($producer);

        return $producer;
    }

    /**
     * @param ProducerRequest $request
     * @return Producer
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     */
    public function update(ProducerRequest $request): Producer
    {
        /** @var Producer $producer */
        $producer = $this->producers->find($request->getId());

        if (null !== $request->getName()) {
            $producer->setName($request->getName());
        }

        if (null !== $request->getCountry()) {
            $producer->setCountry($this->countries->findByCode($request->getCountry()));
        }

        return $producer;
    }

    /**
     * @param ProducerRequest $request
     * @return Producer
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function delete(ProducerRequest $request): Producer
    {
        /** @var Producer $producer */
        $producer = $this->producers->find($request->getId());

        $this->producers->delete($producer);

        return $producer;
    }

    /**
     * @param ProducerRequest $request
     * @return Producer
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function create(ProducerRequest $request): Producer
    {
        $country = $this->countries->findByCode($request->getCountry());
        $producer = new Producer($request->getName(), $country);

        $producer->setPublished(false);

        $this->producers->save($producer);

        return $producer;
    }
}