<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 11:38 AM
 */

namespace Skipper\Films\Repositories;

use Skipper\Films\Entities\Movie;
use Skipper\Repository\Contracts\Repository;
use Skipper\Repository\Exceptions\EntityNotFoundException;

interface MovieRepository extends Repository
{
    /**
     * Get all available info for movie
     *
     * @param int $id
     * @return Movie
     * @throws EntityNotFoundException
     */
    public function getMovie(int $id): Movie;
}