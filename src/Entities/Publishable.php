<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 3:43 PM
 */

namespace Skipper\Films\Entities;


use Skipper\Repository\Contracts\Entity;

trait Publishable
{
    /**
     * @var bool
     */
    protected $published = false;

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return Entity
     */
    public function setPublished(bool $published): Entity
    {
        $this->published = $published;
        return $this;
    }
}