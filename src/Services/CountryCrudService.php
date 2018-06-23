<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 1:01 PM
 */

namespace Skipper\Films\Services;

use Skipper\Films\Entities\Country;
use Skipper\Films\Repositories\CountryRepository;
use Skipper\Films\Requests\CountryRequest;

class CountryCrudService
{
    /**
     * @var CountryRepository
     */
    protected $countries;

    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    /**
     * @param CountryRequest $request
     * @return Country
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function delete(CountryRequest $request): Country
    {
        /** @var Country $country */
        $country = $this->countries->findByCode($request->getCode());

        $this->countries->delete($country);

        return $country;
    }

    /**
     * @param CountryRequest $request
     * @return Country
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function create(CountryRequest $request): Country
    {
        $country = new Country(
            $request->getCode(),
            $request->getFlag()
        );

        $this->countries->save($country);

        return $country;
    }
}