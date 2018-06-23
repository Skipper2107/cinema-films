<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 10:59 AM
 */

namespace Skipper\Films\Services;

use Skipper\Films\Entities\Celebrity;
use Skipper\Films\Entities\Country;
use Skipper\Films\Repositories\CelebrityRepository;
use Skipper\Films\Repositories\CountryRepository;
use Skipper\Films\Requests\CelebrityRequest;

class CelebrityCrudService
{

    /**
     * @var CelebrityRepository
     */
    protected $celebrities;

    /**
     * @var CountryRepository
     */
    protected $countries;

    public function __construct(CelebrityRepository $celebrities, CountryRepository $countries)
    {
        $this->celebrities = $celebrities;
        $this->countries = $countries;
    }

    /**
     * @param CelebrityRequest $request
     * @return Celebrity
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function create(CelebrityRequest $request): Celebrity
    {
        /** @var Country $country */
        $country = $this->countries->findByCode($request->getCountry());

        $celebrity = new Celebrity(
            $request->getName(),
            $request->getOriginalName(),
            new \DateTime($request->getBirth()),
            $country,
            $request->getAvatar(),
            $request->getBiography()
        );

        $celebrity->setLocale($request->getLocale());

        $this->celebrities->save($celebrity);

        return $celebrity;
    }

    /**
     * @param CelebrityRequest $request
     * @return Celebrity
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function toggle(CelebrityRequest $request): Celebrity
    {
        /** @var Celebrity $celebrity */
        $celebrity = $this->celebrities->find($request->getId());

        $celebrity->setPublished($request->getPublished());

        $this->celebrities->save($celebrity);

        return $celebrity;
    }

    /**
     * @param CelebrityRequest $request
     * @return Celebrity
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function updateGeneralInfo(CelebrityRequest $request): Celebrity
    {
        /** @var Celebrity $celebrity */
        $celebrity = $this->celebrities->find($request->getId());

        if (null !== $request->getAvatar()) {
            $celebrity->setAvatar($request->getAvatar());
        }

        if (null !== $request->getCountry()) {
            /** @var Country $country */
            $country = $this->countries->findByCode($request->getCountry());
            $celebrity->setCountry($country);
        }

        if (null !== $request->getBirth()) {
            $celebrity->setBirth(new \DateTime($request->getAvatar()));
        }

        if (null !== $request->getOriginalName()) {
            $celebrity->setOriginalName($request->getOriginalName());
        }

        $this->celebrities->save($celebrity);

        return $celebrity;
    }

    /**
     * @param CelebrityRequest $request
     * @return Celebrity
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function updateLocale(CelebrityRequest $request): Celebrity
    {
        /** @var Celebrity $celebrity */
        $celebrity = $this->celebrities->find($request->getId());

        $celebrity->setLocale($request->getLocale());
        $celebrity->setName($request->getName())
            ->setBiography($request->getBiography());

        $this->celebrities->save($celebrity);

        return $celebrity;
    }

    /**
     * @param CelebrityRequest $request
     * @return Celebrity
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function delete(CelebrityRequest $request): Celebrity
    {
        /** @var Celebrity $celebrity */
        $celebrity = $this->celebrities->find($request->getId());

        $this->celebrities->delete($celebrity);

        return $celebrity;
    }
}