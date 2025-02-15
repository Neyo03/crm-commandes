<?php

namespace App\Service\Security;

use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;
use App\Entity\User;

class LoginLinkService
{
    public function __construct(private LoginLinkHandlerInterface $loginLinkHandler) {}

    public function generateLoginLink(User $user): string
    {
        $loginLinkDetails = $this->loginLinkHandler->createLoginLink($user);
        return $loginLinkDetails->getUrl();
    }
}
