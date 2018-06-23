<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 11:04 AM
 */

namespace Skipper\Films\Entities;

use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\HasId;

class Producer implements Entity
{
    use HasId;
    use Publishable;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Country
     */
    protected $country;

    /**
     * Producer constructor.
     * @param string $name
     * @param Country $country
     */
    public function __construct(string $name, Country $country)
    {
        $this->name = $name;
        $this->country = $country;
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
     * @return Producer
     */
    public function setName(string $name): Producer
    {
        $this->name = $name;
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
     * @return Producer
     */
    public function setCountry(Country $country): Producer
    {
        $this->country = $country;
        return $this;
    }
}