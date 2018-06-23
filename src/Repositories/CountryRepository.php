<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/21/18
 * Time: 11:59 AM
 */

namespace Skipper\Films\Repositories;

use Skipper\Films\Entities\Country;
use Skipper\Repository\Contracts\Repository;
use Skipper\Repository\Exceptions\EntityNotFoundException;

interface CountryRepository extends Repository
{
    /**
     * @param string $code
     * @return Country
     * @throws EntityNotFoundException
     */
    public function findByCode(string $code): Country;

    /**
     * @param string[] $codes
     * @return Country[]
     */
    public function findAllByCodes(array $codes): array;
}