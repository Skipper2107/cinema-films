<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 11:08 AM
 */

namespace Skipper\Films\Entities;

use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\HasId;

class Celebrity implements Entity
{
    use HasId;
    use Publishable;
    use Localed;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $originalName;

    /**
     * @var \DateTimeInterface
     */
    protected $birth;

    /**
     * @var Country
     */
    protected $country;

    /**
     * @var string
     */
    protected $avatar;

    /**
     * @var string
     */
    protected $biography;

    /**
     * Celebrity constructor.
     * @param string $name
     * @param string $originalName
     * @param \DateTimeInterface $birth
     * @param Country $country
     * @param string $avatar
     * @param string $biography
     */
    public function __construct(
        string $name,
        string $originalName,
        \DateTimeInterface $birth,
        Country $country,
        string $avatar,
        string $biography
    ) {
        $this->name = $name;
        $this->originalName = $originalName;
        $this->birth = $birth;
        $this->country = $country;
        $this->avatar = $avatar;
        $this->biography = $biography;
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
     * @return Celebrity
     */
    public function setName(string $name): Celebrity
    {
        $this->name = $name;
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
     * @return Celebrity
     */
    public function setOriginalName(string $originalName): Celebrity
    {
        $this->originalName = $originalName;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getBirth(): \DateTimeInterface
    {
        return $this->birth;
    }

    /**
     * @param \DateTimeInterface $birth
     * @return Celebrity
     */
    public function setBirth(\DateTimeInterface $birth): Celebrity
    {
        $this->birth = $birth;
        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     * @return Celebrity
     */
    public function setCountry(Country $country): Celebrity
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return Celebrity
     */
    public function setAvatar(string $avatar): Celebrity
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     * @return Celebrity
     */
    public function setBiography(string $biography): Celebrity
    {
        $this->biography = $biography;
        return $this;
    }
}