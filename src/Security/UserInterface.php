<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

interface UserInterface extends SymfonyUserInterface
{
    public function getId(): ?int;
    public function getUsername(): string;
    public function getRoles(): array;
    public function getPassword(): string;
    public function getSalt(): ?string;
    public function eraseCredentials(): void;
}