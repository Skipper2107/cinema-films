<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 12:29 PM
 */

namespace Skipper\Films\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class CountryRequest
{
    /**
     * @var string|null
     * @Assert\Regex(message="type.country", pattern="/^[A-Z]{2}$/")
     * @Assert\NotBlank(message="empty")
     */
    protected $code;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty")
     * @Assert\Type(message="type.string", type="string")
     */
    protected $flag;

    public function __construct($code, $flag)
    {
        $this->code = $code;
        $this->flag = $flag;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return null|string
     */
    public function getFlag(): ?string
    {
        return $this->flag;
    }
}