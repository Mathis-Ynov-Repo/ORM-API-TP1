<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article extends AbstractEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("articles:details")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("articles:details")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *  @Groups("articles:details")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Choice(callback={"App\Article\Status", "getStatus"})
     *  @Groups("articles:details")
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     *  @Groups("articles:details")
     */
    private $trending;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     *  @Groups("articles:details")
     */
    private $category;

    /**
     * @ORM\Column(type="date", nullable=true)
     *  @Groups("articles:details")
     */
    private $published;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTrending(): ?bool
    {
        return $this->trending;
    }

    public function setTrending(bool $trending): self
    {
        $this->trending = $trending;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setPublished(?\DateTimeInterface $published): self
    {
        $this->published = $published;

        return $this;
    }
}
