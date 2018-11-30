<?php
/**
 * Created by PhpStorm.
 * User: Sylvanus KONAN
 * Date: 17/11/2018
 * Time: 21:04
 */

namespace LSI\MarketBundle\Listener;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirectListener implements AuthenticationSuccessHandlerInterface {

    private $router;

    /**
     * AfterLoginRedirectListener constructor.
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router) {
        //parent::__construct();
        $this->router = $router;

    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {

        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_ADMIN', $rolesTab, true)) {
            // c'est un aministrateur : on le rediriger vers son espace
            return new RedirectResponse($this->router->generate('ls_imarket_admin'));
        }
        else if(in_array('ROLE_SUPER_ADMIN', $rolesTab, true)) {
            // c'est le super admin : on le rediriger vers son espace
            return new RedirectResponse($this->router->generate('ls_imarket_superadmin'));
        }
        else if (in_array('ROLE_MAIRIE', $rolesTab, true)){
            //c'est une mairie ...
            return new RedirectResponse($this->router->generate('ls_imarket_mon_espace'));
        }
        else if (in_array('ROLE_MEMBRE', $rolesTab, true)){
            // c'est un membre de mairie ...
            return new RedirectResponse($this->router->generate('ls_imarket_espace_membre'));
        }
        else if (in_array('ROLE_PART', $rolesTab, true)){
            // c'est un administre ...
            return new RedirectResponse($this->router->generate('ls_imarket_mon_espace'));
        }
    }

}