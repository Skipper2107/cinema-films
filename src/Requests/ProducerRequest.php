<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 1:09 PM
 */

namespace Skipper\Films\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class ProducerRequest
{
    /**
     * @var int|null
     * @Assert\NotBlank(message="empty", groups={"update", "delete", "toggle"})
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
    protected $name;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\Country(message="type.country")
     */
    protected $country;

    public function __construct($id, $published, $name, $country)
    {
        $this->id = $id;
        $this->published = $published;
        $this->name = $name;
        $this->country = $country;
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }


}