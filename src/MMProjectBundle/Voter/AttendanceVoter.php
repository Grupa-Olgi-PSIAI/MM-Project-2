<?php

namespace MMProjectBundle\Voter;


use MMProjectBundle\Entity\Attendance;
use MMProjectBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AttendanceVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    private $authorizationChecker;

    public function __construct(ContainerInterface $serviceContainer)
    {
        $this->authorizationChecker = $serviceContainer->get('security.authorization_checker');
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        if (!$subject instanceof Attendance) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($subject, $user);
            case self::EDIT:
                return $this->canEdit($subject, $user);
        }

        return false;
    }

    private function canView(Attendance $attendance, User $user)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ALLOWED_VIEW_ATTENDANCE_OTHERS')) {
            return true;
        } elseif ($attendance->getUser() === $user) {
            return true;
        }

        return false;
    }

    private function canEdit(Attendance $attendance, User $user)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ALLOWED_EDIT_ATTENDANCE_OTHERS')) {
            return true;
        } elseif ($attendance->getUser() === $user) {
            return true;
        }

        return false;
    }
}
