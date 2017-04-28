<?php

namespace Vatencio\SgisBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
#use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
 
class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
       // $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
        }

        return $this->render('VatencioSgisBundle:Security:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(Security::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    public function getTokenAction()
    {
        return new Response($this->container->get('security.csrf.token_manager')
            ->getToken('authenticate'));
    }

}
