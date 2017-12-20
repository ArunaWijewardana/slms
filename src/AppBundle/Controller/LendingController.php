<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lending;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Translator;

/**
 * Lending controller.
 *
 * @Route("lending/{_locale}")
 */
class LendingController extends Controller
{
    /**
     * Lists all lending entities.
     *
     * @Route("/", name="lending_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $lendings = $em->getRepository('AppBundle:Lending')->findAll();
        //dump($lendings); exit;
        return $this->render('lending/index.html.twig', array(
            'lendings' => $lendings,
            'request' => $request,
        ));
    }

    /**
     * Creates a new lending entity.
     *
     * @Route("/new", name="lending_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lending = new Lending();
        $form = $this->createForm('AppBundle\Form\LendingType', $lending);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lending);
            $em->flush();

            return $this->redirectToRoute('lending_show', array('id' => $lending->getId()));
        }

        return $this->render('lending/new.html.twig', array(
            'lending' => $lending,
            'form' => $form->createView(),
            'request' => $request,
        ));
    }

    /**
     * Finds and displays a lending entity.
     *
     * @Route("/{id}", name="lending_show")
     * @Method("GET")
     */
    public function showAction(Request $request, Lending $lending)
    {
        $deleteForm = $this->createDeleteForm($lending);

        return $this->render('lending/show.html.twig', array(
            'lending' => $lending,
            'delete_form' => $deleteForm->createView(),
            'request' => $request,
        ));
    }

    /**
     * Displays a form to edit an existing lending entity.
     *
     * @Route("/{id}/edit", name="lending_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lending $lending)
    {
        $lending->setModifiedAt(new \DateTime('now'));
        $deleteForm = $this->createDeleteForm($lending);
        $editForm = $this->createForm('AppBundle\Form\LendingType', $lending);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lending_edit', array('id' => $lending->getId()));
        }

        return $this->render('lending/edit.html.twig', array(
            'lending' => $lending,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'request' => $request,
        ));
    }

    /**
     * Deletes a lending entity.
     *
     * @Route("/{id}", name="lending_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Lending $lending)
    {
        $form = $this->createDeleteForm($lending);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lending);
            $em->flush();
        }

        return $this->redirectToRoute('lending_index');
    }

    /**
     * Creates a form to delete a lending entity.
     *
     * @param Lending $lending The lending entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lending $lending)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lending_delete', array('id' => $lending->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
