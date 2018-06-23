<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 11:01 AM
 */

namespace Skipper\Films\Entities;

use Skipper\Repository\Contracts\Entity;

trait Localed
{
    /**
     * @var string
     */
    protected $locale;

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return Entity
     */
    public function setLocale(string $locale): Entity
    {
        $this->locale = $locale;
        return $this;
    }
}