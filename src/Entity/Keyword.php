<?php

namespace App\Entity;

use App\Repository\KeywordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KeywordRepository::class)]
class Keyword
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Bookmark>
     */
    #[ORM\ManyToMany(targetEntity: Bookmark::class, inversedBy: 'keywords')]
    private Collection $bookmark;

    public function __construct()
    {
        $this->bookmark = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Bookmark>
     */
    public function getBookmark(): Collection
    {
        return $this->bookmark;
    }

    public function addBookmark(Bookmark $bookmark): static
    {
        if (!$this->bookmark->contains($bookmark)) {
            $this->bookmark->add($bookmark);
        }

        return $this;
    }

    public function removeBookmark(Bookmark $bookmark): static
    {
        $this->bookmark->removeElement($bookmark);

        return $this;
    }
}
