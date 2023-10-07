<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\DataFixtures\Blog;
use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ApiResource]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['blog'])]
    private ?string $content = null;
    #[Groups(['blog'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author = null;
    #[Groups(['blog'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;
    #[Groups(['comment'])]
    #[ORM\ManyToOne( targetEntity: BlogPost::class, inversedBy: 'comments')]
    private BlogPost $blog;

    // #[ORM\ManyToOne(targetEntity: BlogPost::class, inversedBy: 'comments')]
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBlog(): BlogPost
    {
        return $this->blog;
    }
    public function setBlog(BlogPost $blog): static
    {
        $this->blog = $blog;

        return $this;
    }

    // /**
    //  * @return Collection<int, BlogPost>
    //  */
    // public function getBlog(): Collection
    // {
    //     return $this->blog;
    // }

    // public function addBlog(BlogPost $blog): static
    // {
    //     if (!$this->blog->contains($blog)) {
    //         $this->blog->add($blog);
    //         $blog->setBlogs($this);
    //     }

    //     return $this;
    // }

    // public function removeBlog(BlogPost $blog): static
    // {
    //     if ($this->blog->removeElement($blog)) {
    //         // set the owning side to null (unless already changed)
    //         if ($blog->getBlogs() === $this) {
    //             $blog->setBlogs(null);
    //         }
    //     }

    //     return $this;
    // }
}
