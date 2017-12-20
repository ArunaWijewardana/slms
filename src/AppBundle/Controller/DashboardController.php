<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="redirect", defaults={"_locale": "en"})
     */
    public function redirectAction(Request $request)
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->render('dashboard/index.html.twig', array(
                'request' => $request
            ));
        }
        return $this->render('security/login.html.twig', array(
            'request' => $request
        ));
    }

    /**
     * @Route("dashboard/{_locale}", name="dashboard", defaults={"_locale": "en"})
     */
    public function indexAction(Request $request)
    {
        return $this->render('dashboard/index.html.twig', array(
            'request' => $request
        ));
    }
}
