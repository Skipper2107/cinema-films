<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 10:59 AM
 */

namespace Skipper\Films\Entities;

use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\HasId;

class Genre implements Entity
{
    use HasId;
    use Publishable;
    use Localed;

    /**
     * @var string
     */
    protected $name;

    /**
     * Genre constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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
     * @return Genre
     */
    public function setName(string $name): Genre
    {
        $this->name = $name;
        return $this;
    }
}