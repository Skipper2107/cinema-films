<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 11:17 AM
 */

namespace Skipper\Films\Entities;

use Skipper\Repository\Contracts\Entity;
use Skipper\Repository\HasId;

class Country implements Entity
{
    use HasId;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $flag;

    /**
     * Country constructor.
     * @param string $name
     * @param string $flag
     */
    public function __construct(string $name, string $flag)
    {
        $this->code = $name;
        $this->flag = $flag;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Country
     */
    public function setCode(string $code): Country
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getFlag(): string
    {
        return $this->flag;
    }

    /**
     * @param string $flag
     * @return Country
     */
    public function setFlag(string $flag): Country
    {
        $this->flag = $flag;
        return $this;
    }
}