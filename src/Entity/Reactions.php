<?php

namespace App\Entity;

use App\Repository\ReactionsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: ReactionsRepository::class)]
#[ApiResource]
class Reactions
{
    //#[ORM\Column(name: "user_id")]
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $user_id = null;

    //#[ORM\Column(name: "post_id")]
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reactions')]
    #[ORM\JoinColumn(nullable: false)]
  
    private ?posts $post_id = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;


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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
