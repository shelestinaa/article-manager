<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::TEXT)]
    private string $picture;

    #[ORM\Column(type: Types::TEXT)]
    private string $title;

    #[ORM\Column(type: Types::TEXT)]
    private string $caption;

    #[ORM\Column(type: Types::TEXT)]
    private string $preview;

    #[ORM\Column(type: Types::JSON)]
    private array $tags = [];

    #[ORM\Column(type: Types::TEXT)]
    private string $slug;

    #[ORM\Column(type: Types::TEXT)]
    private string $detailText;

    #[ORM\Column(type: Types::TEXT)]
    private string $metaDescription;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private \DateTimeImmutable $dateCreated;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId(int $id): Article
    {
        $this->id = $id;
        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setPreview(string $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Article
     */
    public function setSlug(string $slug): Article
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getDetailText(): string
    {
        return $this->detailText;
    }

    /**
     * @param string $detailText
     * @return Article
     */
    public function setDetailText(string $detailText): Article
    {
        $this->detailText = $detailText;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     * @return Article
     */
    public function setMetaDescription(string $metaDescription): Article
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateCreated(): \DateTimeImmutable
    {
        return $this->dateCreated;
    }

    /**
     * @param string $dateCreated
     * @return Article
     */
    public function setDateCreated(\DateTimeImmutable $dateCreated): Article
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }


}
