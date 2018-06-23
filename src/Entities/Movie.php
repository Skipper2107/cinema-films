<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 10:50 AM
 */

namespace Skipper\Films\Entities;

use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\HasId;

class Movie implements Entity
{
    use HasId;
    use Publishable;
    use Localed;

    /**
     * @var string
     */
    protected $originalName;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $duration;

    /**
     * @var \DateTimeInterface
     */
    protected $releaseDate;

    /**
     * @var Country[]
     */
    protected $countries = [];

    /**
     * @var Genre[]
     */
    protected $genres = [];

    /**
     * @var string
     */
    protected $ageRestriction = MPAARating::G;

    /**
     * @var string
     */
    protected $teaser;

    /**
     * @var string[]
     */
    protected $trailers = [];

    /**
     * @var string
     */
    protected $plot;

    /**
     * @var Producer[]
     */
    protected $producers = [];

    /**
     * @var Celebrity[]
     */
    protected $cast = [];

    /**
     * @var Celebrity[]
     */
    protected $directors = [];

    /**
     * @var Celebrity[]
     */
    protected $writers = [];

    /**
     * @var Celebrity[]
     */
    protected $photographyDirectors = [];

    /**
     * @var string
     */
    protected $poster;

    /**
     * Movie constructor.
     * @param string $name
     * @param string $originalName
     * @param \DateTimeInterface $releaseDate
     * @param int $duration
     * @param string $poster
     */
    public function __construct(
        string $name,
        string $originalName,
        \DateTimeInterface $releaseDate,
        int $duration,
        string $poster
    ) {
        $this->name = $name;
        $this->originalName = $originalName;
        $this->releaseDate = $releaseDate;
        $this->duration = $duration;
        $this->poster = $poster;
    }

    /**
     * @return Country[]
     */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
     * @param Country[] $countries
     * @return Movie
     */
    public function setCountries(array $countries): Movie
    {
        $this->countries = $countries;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     * @return Movie
     */
    public function setOriginalName(string $originalName): Movie
    {
        $this->originalName = $originalName;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Movie
     */
    public function setName(string $name): Movie
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return Movie
     */
    public function setDuration(int $duration): Movie
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReleaseDate(): \DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTimeInterface $releaseDate
     * @return Movie
     */
    public function setReleaseDate(\DateTimeInterface $releaseDate): Movie
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return Genre[]
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param Genre[] $genres
     * @return Movie
     */
    public function setGenres(array $genres): Movie
    {
        $this->genres = $genres;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgeRestriction(): string
    {
        return $this->ageRestriction;
    }

    /**
     * @param string $ageRestriction
     * @return Movie
     */
    public function setAgeRestriction(string $ageRestriction): Movie
    {
        $this->ageRestriction = $ageRestriction;
        return $this;
    }

    /**
     * @return string
     */
    public function getTeaser(): string
    {
        return $this->teaser;
    }

    /**
     * @param string $teaser
     * @return Movie
     */
    public function setTeaser(string $teaser): Movie
    {
        $this->teaser = $teaser;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getTrailers(): array
    {
        return $this->trailers;
    }

    /**
     * @param string[] $trailers
     * @return Movie
     */
    public function setTrailers(array $trailers): Movie
    {
        $this->trailers = $trailers;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlot(): string
    {
        return $this->plot;
    }

    /**
     * @param string $plot
     * @return Movie
     */
    public function setPlot(string $plot): Movie
    {
        $this->plot = $plot;
        return $this;
    }

    /**
     * @return Producer[]
     */
    public function getProducers(): array
    {
        return $this->producers;
    }

    /**
     * @param Producer[] $creators
     * @return Movie
     */
    public function setProducers(array $creators): Movie
    {
        $this->producers = $creators;
        return $this;
    }

    /**
     * @return Celebrity[]
     */
    public function getCast(): array
    {
        return $this->cast;
    }

    /**
     * @param Celebrity[] $cast
     * @return Movie
     */
    public function setCast(array $cast): Movie
    {
        $this->cast = $cast;
        return $this;
    }

    /**
     * @return Celebrity[]
     */
    public function getDirectors(): array
    {
        return $this->directors;
    }

    /**
     * @param Celebrity[] $directors
     * @return Movie
     */
    public function setDirectors(array $directors): Movie
    {
        $this->directors = $directors;
        return $this;
    }

    /**
     * @return Celebrity[]
     */
    public function getWriters(): array
    {
        return $this->writers;
    }

    /**
     * @param Celebrity[] $writers
     * @return Movie
     */
    public function setWriters(array $writers): Movie
    {
        $this->writers = $writers;
        return $this;
    }

    /**
     * @return Celebrity[]
     */
    public function getPhotographyDirectors(): array
    {
        return $this->photographyDirectors;
    }

    /**
     * @param Celebrity[] $photographyDirectors
     * @return Movie
     */
    public function setPhotographyDirectors(array $photographyDirectors): Movie
    {
        $this->photographyDirectors = $photographyDirectors;
        return $this;
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        return $this->poster;
    }

    /**
     * @param string $poster
     * @return Movie
     */
    public function setPoster(string $poster): Movie
    {
        $this->poster = $poster;
        return $this;
    }


}