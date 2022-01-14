<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=user::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=advert::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advert;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=CommentFlag::class, mappedBy="comment")
     */
    private $commentFlags;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disabled;

    public function __construct()
    {
        $this->commentFlags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAuthor(): ?user
    {
        return $this->author;
    }

    public function setAuthor(?user $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAdvert(): ?advert
    {
        return $this->advert;
    }

    public function setAdvert(?advert $advert): self
    {
        $this->advert = $advert;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|CommentFlag[]
     */
    public function getCommentFlags(): Collection
    {
        return $this->commentFlags;
    }

    public function addCommentFlag(CommentFlag $commentFlag): self
    {
        if (!$this->commentFlags->contains($commentFlag)) {
            $this->commentFlags[] = $commentFlag;
            $commentFlag->setComment($this);
        }

        return $this;
    }

    public function removeCommentFlag(CommentFlag $commentFlag): self
    {
        if ($this->commentFlags->removeElement($commentFlag)) {
            // set the owning side to null (unless already changed)
            if ($commentFlag->getComment() === $this) {
                $commentFlag->setComment(null);
            }
        }

        return $this;
    }

    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function getFlags()
    {
    }
}
