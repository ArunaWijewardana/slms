<?php
/**
 * Created by,
 * User: Aruna Priyankara Wijewardana
 * Date: 12/18/2017
 * Time: 12:24 AM
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends Controller
{
    /**
     * @Route("/settings/{_locale}", name="settings")
     */
    public function searchAction(Request $request)
    {
        if (isset($_GET['locale'])){
            $request->setLocale($_GET['locale']);
        }

        return $this->render('settings/index.html.twig', array(
            'request' => $request,
        ));
    }

}