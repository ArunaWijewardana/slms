<?php
/**
 * Created by,
 * User: Aruna Priyankara Wijewardana
 * Date: 12/17/2017
 * Time: 10:28 PM
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends Controller
{
    /**
     * @Route("/search/{_locale}", name="search")
     */
    public function searchAction(Request $request)
    {
        $search = $_POST['search'];

        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('AppBundle:Book')->findBy(['title' => $search]);
        $books1 = $em->getRepository('AppBundle:Book')->findBy(['author' => $search]);

        $users = $em->getRepository('AppBundle:User')->findBy(['firstName' => $search]);
        $users1 = $em->getRepository('AppBundle:User')->findBy(['lastName' => $search]);

        return $this->render('search/index.html.twig', array(
            'books' => $books,
            'books1' => $books1,
            'users' => $users,
            'users1' => $users1,
            'request' => $request,
        ));
    }
}