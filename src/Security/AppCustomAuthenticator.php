<?php

namespace App\Security;

use App\Entity\Admin;
use App\Entity\Owner;
use App\Entity\SuperAdmin;
use App\Entity\Tenant;
use App\Entity\Employee;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Doctrine\ORM\EntityManagerInterface;

class AppCustomAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private UrlGeneratorInterface $urlGenerator;
    private EntityManagerInterface $entityManager;

    public function __construct(UrlGeneratorInterface $urlGenerator, EntityManagerInterface $entityManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->entityManager = $entityManager;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->getPayload()->getString('email');

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email, function ($userIdentifier) {
                // Check each user type table to find the user
                foreach ([SuperAdmin::class, Admin::class, Owner::class, Tenant::class, Employee::class] as $userClass) {
                    $user = $this->entityManager->getRepository($userClass)->findOneBy(['email' => $userIdentifier]);
                    if ($user) {
                        return $user;
                    }
                }

                throw new AuthenticationException('User not found.');
            }),
            new PasswordCredentials($request->getPayload()->getString('password')),
            [
                new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Check if there is a target path to redirect the user to
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // Redirect based on the user's role
        $user = $token->getUser();
        
        if ($user instanceof SuperAdmin) {
            return new RedirectResponse($this->urlGenerator->generate('super_admin_dashboard'));
        } elseif ($user instanceof Admin) {
            return new RedirectResponse($this->urlGenerator->generate('admin_dashboard'));
        } elseif ($user instanceof Owner) {
            return new RedirectResponse($this->urlGenerator->generate('owner_dashboard'));
        } elseif ($user instanceof Tenant) {
            return new RedirectResponse($this->urlGenerator->generate('tenant_dashboard'));
        } elseif ($user instanceof Employee) {
            return new RedirectResponse($this->urlGenerator->generate('employee_dashboard'));
        }

        // Default fallback
        return new RedirectResponse($this->urlGenerator->generate('default_dashboard'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}