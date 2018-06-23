<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 10:59 AM
 */

namespace Skipper\Films\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class CelebrityRequest
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
     * @var \DateTimeInterface|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\Date(message="type.date")
     */
    protected $birth;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\Country(message="type.country")
     */
    protected $country;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create"})
     * @Assert\Type(type="string", message="type.string")
     */
    protected $avatar;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create", "localed"})
     * @Assert\Type(type="string", message="type.string")
     */
    protected $biography;

    /**
     * @var string|null
     * @Assert\NotBlank(message="empty", groups={"create", "localed"})
     * @Assert\Locale(message="type.locale")
     */
    protected $locale;

    /**
     * CelebrityRequest constructor.
     * @param $id
     * @param $locale
     * @param $published
     * @param $name
     * @param $originalName
     * @param $birth
     * @param $country
     * @param $avatar
     * @param $biography
     */
    public function __construct($id, $locale, $published, $name, $originalName, $birth, $country, $avatar, $biography)
    {
        $this->id = $id;
        $this->locale = $locale;
        $this->published = $published;
        $this->name = $name;
        $this->originalName = $originalName;
        $this->birth = $birth;
        $this->country = $country;
        $this->avatar = $avatar;
        $this->biography = $biography;
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
     * @return \DateTimeInterface|null
     */
    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return null|string
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @return null|string
     */
    public function getBiography(): ?string
    {
        return $this->biography;
    }

    /**
     * @return null|string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }
}