<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 1:30 PM
 */

namespace Skipper\Films\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class GenreRequest
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
     * @Assert\NotBlank(message="empty", groups={"create", "update"})
     * @Assert\Type(type="string", message="type.string")
     * @Assert\Length(max="255", maxMessage="length")
     */
    protected $name;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create", "update"})
     * @Assert\Locale(message="type.locale")
     */
    protected $locale;

    public function __construct($id, $published, $locale, $name)
    {
        $this->id = $id;
        $this->published = $published;
        $this->locale = $locale;
        $this->name = $name;
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
    public function getLocale(): ?string
    {
        return $this->locale;
    }

}