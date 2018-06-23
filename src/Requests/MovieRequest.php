<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 3:38 PM
 */

namespace Skipper\Films\Requests;

use Skipper\Films\Entities\MPAARating as R;
use Symfony\Component\Validator\Constraints as Assert;

class MovieRequest
{
    /**
     * @var int|null
     * @Assert\NotBlank(message="empty", groups={"update", "delete", "toggle", "localed"})
     * @Assert\Type(type="integer", message="type.integer")
     */
    protected $id;

    /**
     * @var boolean|null
     * @Assert\NotBlank(message="empty", groups={"toggle"})
     * @Assert\Type(type="boolean", message="type.boolean")
     */
    protected $published;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\Type(type="string", message="type.string")
     * @Assert\Length(max="255", maxMessage="length")
     */
    protected $originalName;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create", "localed"})
     * @Assert\Type(type="string", message="type.string")
     * @Assert\Length(max="255", maxMessage="length")
     */
    protected $name;

    /**
     * @var int|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\Type(type="integer", message="type.integer")
     * @Assert\GreaterThan(value="0", message="length")
     */
    protected $duration;

    /**
     * @var \DateTimeInterface|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\Date(message="type.date")
     */
    protected $releaseDate;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create", "localed"})
     * @Assert\Locale(message="type.locale")
     */
    protected $locale;

    /**
     * @var string[]|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\All({
     *     @Assert\Country(message="type.country")
     * })
     */
    protected $countries;

    /**
     * @var string[]|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\All({
     *     @Assert\Type(type="string", message="type.string")
     * })
     */
    protected $genres;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\Choice(message="type.mpaa", choices={R::G, R::NC17, R::PG, R::PG13, R::R}, strict=true)
     */
    protected $ageRestriction;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create", "localed"})
     * @Assert\Type(type="string", message="type.string")
     * @Assert\Length(maxMessage="length", max="255")
     */
    protected $teaser;

    /**
     * @var string[]|null
     * @Assert\NotBlank(message="empty", groups={"create", "localed"})
     * @Assert\All({
     *     @Assert\Type(type="string", message="type.string")
     * })
     */
    protected $trailers;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create", "localed"})
     * @Assert\Type(type="string", message="type.string")
     */
    protected $plot;

    /**
     * @var int[]|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\All({
     *     @Assert\Type(type="integer", message="type.integer")
     * })
     */
    protected $producers;

    /**
     * @var int[]|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\All({
     *     @Assert\Type(type="integer", message="type.integer")
     * })
     */
    protected $cast;

    /**
     * @var int[]|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\All({
     *     @Assert\Type(type="integer", message="type.integer")
     * })
     */
    protected $directors;

    /**
     * @var int[]|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\All({
     *     @Assert\Type(type="integer", message="type.integer")
     * })
     */
    protected $writers;

    /**
     * @var int[]|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\All({
     *     @Assert\Type(type="integer", message="type.integer")
     * })
     */
    protected $photographyDirectors;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create", "localed"})
     * @Assert\Type(type="string", message="type.string")
     */
    protected $poster;

    /**
     * MovieRequest constructor.
     * @param $id
     * @param $locale
     * @param $published
     * @param $originalName
     * @param $name
     * @param $duration
     * @param $releaseDate
     * @param $countries
     * @param $genres
     * @param $ageRestriction
     * @param $teaser
     * @param $trailers
     * @param $plot
     * @param $producers
     * @param $cast
     * @param $directors
     * @param $photographyDirectors
     * @param $writers
     * @param $poster
     */
    public function __construct(
        $id,
        $locale,
        $published,
        $originalName,
        $name,
        $duration,
        $releaseDate,
        $countries,
        $genres,
        $ageRestriction,
        $teaser,
        $trailers,
        $plot,
        $producers,
        $cast,
        $directors,
        $photographyDirectors,
        $writers,
        $poster
    ) {
        $this->id = $id;
        $this->locale = $locale;
        $this->published = $published;
        $this->originalName = $originalName;
        $this->name = $name;
        $this->duration = $duration;
        $this->releaseDate = $releaseDate;
        $this->countries = $countries;
        $this->genres = $genres;
        $this->ageRestriction = $ageRestriction;
        $this->teaser = $teaser;
        $this->trailers = $trailers;
        $this->plot = $plot;
        $this->producers = $producers;
        $this->cast = $cast;
        $this->directors = $directors;
        $this->photographyDirectors = $photographyDirectors;
        $this->poster = $poster;
        $this->writers = $writers;
    }

    /**
     * @return null|string[]
     */
    public function getTrailers(): ?array
    {
        return $this->trailers;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function getPublished(): ?bool
    {
        return $this->published;
    }

    /**
     * @return null|string
     */
    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * @return null|string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @return null|string[]
     */
    public function getCountries(): ?array
    {
        return $this->countries;
    }

    /**
     * @return null|string[]
     */
    public function getGenres(): ?array
    {
        return $this->genres;
    }

    /**
     * @return null|string
     */
    public function getAgeRestriction(): ?string
    {
        return $this->ageRestriction;
    }

    /**
     * @return null|string
     */
    public function getTeaser(): ?string
    {
        return $this->teaser;
    }

    /**
     * @return null|string
     */
    public function getPlot(): ?string
    {
        return $this->plot;
    }

    /**
     * @return int[]|null
     */
    public function getProducers(): ?array
    {
        return $this->producers;
    }

    /**
     * @return int[]|null
     */
    public function getCast(): ?array
    {
        return $this->cast;
    }

    /**
     * @return int[]|null
     */
    public function getDirectors(): ?array
    {
        return $this->directors;
    }

    /**
     * @return int[]|null
     */
    public function getWriters(): ?array
    {
        return $this->writers;
    }

    /**
     * @return int[]|null
     */
    public function getPhotographyDirectors(): ?array
    {
        return $this->photographyDirectors;
    }

    /**
     * @return null|string
     */
    public function getPoster(): ?string
    {
        return $this->poster;
    }
}