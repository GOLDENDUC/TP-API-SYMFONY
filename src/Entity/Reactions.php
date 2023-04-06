<?php

namespace App\Entity;

use App\Repository\ReactionsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: ReactionsRepository::class)]
#[ApiResource]
class Reactions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'reactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?posts $post_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?users
    {
        return $this->user_id;
    }

    public function setUserId(?users $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPostId(): ?posts
    {
        return $this->post_id;
    }

    public function setPostId(?posts $post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }
}
