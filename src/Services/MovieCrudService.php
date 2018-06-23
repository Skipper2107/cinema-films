<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 11:43 AM
 */

namespace Skipper\Films\Services;

use Skipper\Films\Entities\Movie;
use Skipper\Films\Repositories\CelebrityRepository;
use Skipper\Films\Repositories\CountryRepository;
use Skipper\Films\Repositories\ProducerRepository;
use Skipper\Films\Repositories\GenreRepository;
use Skipper\Films\Repositories\MovieRepository;
use Skipper\Films\Requests\MovieRequest;

class MovieCrudService
{
    /**
     * @var MovieRepository
     */
    protected $movies;

    /**
     * @var CountryRepository
     */
    protected $countries;

    /**
     * @var CelebrityRepository
     */
    protected $celebrities;

    /**
     * @var ProducerRepository
     */
    protected $producers;

    /**
     * @var GenreRepository
     */
    protected $genres;

    /**
     * MovieCrudService constructor.
     * @param MovieRepository $movies
     * @param CountryRepository $countries
     * @param CelebrityRepository $celebrities
     * @param GenreRepository $genres
     * @param ProducerRepository $producers
     */
    public function __construct(
        MovieRepository $movies,
        CountryRepository $countries,
        CelebrityRepository $celebrities,
        GenreRepository $genres,
        ProducerRepository $producers
    ) {
        $this->movies = $movies;
        $this->countries = $countries;
        $this->celebrities = $celebrities;
        $this->producers = $producers;
        $this->genres = $genres;
    }

    /**
     * @param MovieRequest $request
     * @return Movie
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function create(MovieRequest $request): Movie
    {
        $movie = new Movie(
            $request->getName(),
            $request->getOriginalName(),
            new \DateTime($request->getReleaseDate()),
            $request->getDuration(),
            $request->getPoster()
        );

        [$cast, $writers, $directors, $operators] = $this->grabCreators($request);

        $movie
            ->setCountries($this->countries->findAllByCodes($request->getCountries()))
            ->setAgeRestriction($request->getAgeRestriction())
            ->setCast($cast ?? [])
            ->setProducers($this->producers->findAll([
                'filter' => [
                    'id' => [
                        'operator' => 'in',
                        'value' => $request->getProducers(),
                    ],
                ],
            ]))
            ->setDirectors($directors ?? [])
            ->setPhotographyDirectors($operators ?? [])
            ->setWriters($writers ?? [])
            ->setGenres($this->genres->findAll([
                'filter' => [
                    'name' => [
                        'operator' => 'in',
                        'value' => $request->getGenres(),
                    ],
                ],
            ]))
            ->setPlot($request->getPlot())
            ->setPoster($request->getPoster())
            ->setTeaser($request->getTeaser())
            ->setTrailers($request->getTrailers())
            ->setLocale($request->getLocale());
        $movie->setPublished(false);

        $this->movies->save($movie);

        return $movie;
    }

    /**
     * @param MovieRequest $request
     * @return array
     */
    private function grabCreators(MovieRequest $request): array
    {
        $castId = (array)$request->getCast();
        $writersId = (array)$request->getWriters();
        $directorsId = (array)$request->getDirectors();
        $operatorsId = (array)$request->getPhotographyDirectors();

        $people = $this->celebrities->findAll([
            'filter' => [
                'id' => [
                    'operator' => 'in',
                    'value' => array_merge(
                        $castId,
                        $writersId,
                        $directorsId,
                        $operatorsId
                    ),
                ],
            ],
        ]);

        [$cast, $writers, $directors, $operators] = [[], [], [], []];

        foreach ($people as $celebrity) {
            $id = $celebrity->getId();
            if (in_array($id, $castId)) {
                $cast[] = $celebrity;
            }

            if (in_array($id, $writersId)) {
                $writers[] = $celebrity;
            }

            if (in_array($id, $directorsId)) {
                $directors[] = $celebrity;
            }

            if (in_array($id, $operatorsId)) {
                $operators[] = $celebrity;
            }
        }

        return [$cast, $writers, $directors, $operators];
    }

    /**
     * @param MovieRequest $request
     * @return Movie
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     */
    public function updateGeneralInfo(MovieRequest $request): Movie
    {
        /** @var Movie $movie */
        $movie = $this->movies->find($request->getId());

        if (null !== $request->getOriginalName()) {
            $movie->setOriginalName($request->getOriginalName());
        }

        if (null !== $request->getDuration()) {
            $movie->setDuration($request->getDuration());
        }

        if (null !== $request->getCountries()) {
            $movie->setCountries($this->countries->findAllByCodes($request->getCountries()));
        }

        if (null !== $request->getGenres()) {
            $movie->setGenres($this->genres->findAll([
                'filter' => [
                    'name' => [
                        'operator' => 'in',
                        'value' => $request->getGenres(),
                    ],
                ],
            ]));
        }

        if (null !== $request->getAgeRestriction()) {
            $movie->setAgeRestriction($request->getAgeRestriction());
        }

        if (null !== $request->getReleaseDate()) {
            $movie->setReleaseDate(new \DateTime($request->getReleaseDate()));
        }

        if (null !== $request->getProducers()) {
            $movie->setProducers($this->producers->findAll([
                'filter' => [
                    'id' => [
                        'operator' => 'in',
                        'value' => $request->getProducers(),
                    ],
                ],
            ]));
        }

        [$cast, $writers, $directors, $operators] = $this->grabCreators($request);

        if (false === empty($cast)) {
            $movie->setCast($cast);
        }

        if (false === empty($writers)) {
            $movie->setWriters($writers);
        }

        if (false === empty($directors)) {
            $movie->setDirectors($directors);
        }

        if (false === empty($operators)) {
            $movie->setPhotographyDirectors($operators);
        }

        return $movie;
    }

    /**
     * @param MovieRequest $request
     * @return Movie
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function updateLocale(MovieRequest $request): Movie
    {
        /** @var Movie $movie */
        $movie = $this->movies->find($request->getId());

        $movie
            ->setName($request->getName())
            ->setTeaser($request->getTeaser())
            ->setTrailers($request->getTrailers())
            ->setPlot($request->getPlot())
            ->setPoster($request->getPoster())
            ->setLocale($request->getLocale());

        $this->movies->save($movie);

        return $movie;
    }

    /**
     * @param MovieRequest $request
     * @return Movie
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function toggle(MovieRequest $request): Movie
    {
        /** @var Movie $movie */
        $movie = $this->movies->find($request->getId());

        $movie->setPublished($request->getPublished());

        $this->movies->save($movie);

        return $movie;
    }

    /**
     * @param MovieRequest $request
     * @return Movie
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function delete(MovieRequest $request): Movie
    {
        /** @var Movie $movie */
        $movie = $this->movies->find($request->getId());

        $this->movies->delete($movie);

        return $movie;
    }
}