<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/25/18
 * Time: 10:14 AM
 */

namespace Skipper\Films\Mappers;

use Skipper\Exceptions\HttpCode;
use Skipper\Films\Entities\Celebrity;
use Skipper\Films\Entities\Country;
use Skipper\Films\Entities\Genre;
use Skipper\Films\Entities\Producer;
use Skipper\Films\Exceptions\FilmException;

class MapperFactory
{
    /**
     * @param string $entityName
     * @return MapperInterface
     * @throws FilmException
     */
    public function getMapper(string $entityName): MapperInterface
    {
        switch ($entityName) {
            case MovieMapper::class:
                return new MovieMapper;
            case Country::class:
                return new CountryMapper;
            case Celebrity::class:
                return new CelebrityMapper(new CountryMapper);
            case Genre::class:
                return new GenreMapper;
            case Producer::class:
                return new ProducerMapper(new CountryMapper);
            default:
                throw new FilmException(HttpCode::forbidden(), 'Unknown entity type', [
                    'className' => $entityName,
                ]);
        }
    }
}