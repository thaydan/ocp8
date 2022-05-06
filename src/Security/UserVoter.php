<?php

namespace App\Security;

use App\Entity\User;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class UserVoter extends Voter
{
    // these strings are just invented: you can use anything
    public const EDIT = 'edit';
    public const DELETE = 'delete';

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        // only vote on `User` objects
        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // only ROLE_ADMIN can continue
        if (!$this->security->isGranted('ROLE_ADMIN')) {
            return false;
        }

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        switch ($attribute) {
            case self::EDIT:
                return true;
            case self::DELETE:
                return $user !== $subject;
        }

        throw new LogicException('This code should not be reached!');
    }
}