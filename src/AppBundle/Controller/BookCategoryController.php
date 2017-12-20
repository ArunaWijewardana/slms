<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BookCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Bookcategory controller.
 *
 * @Route("bookcategory/{_locale}")
 */
class BookCategoryController extends Controller
{
    /**
     * Lists all bookCategory entities.
     *
     * @Route("/", name="bookcategory_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $bookCategories = $em->getRepository('AppBundle:BookCategory')->findAll();

        return $this->render('bookcategory/index.html.twig', array(
            'bookCategories' => $bookCategories,
            'request' => $request,
        ));
    }

    /**
     * Creates a new bookCategory entity.
     *
     * @Route("/new", name="bookcategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bookCategory = new Bookcategory();
        $form = $this->createForm('AppBundle\Form\BookCategoryType', $bookCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bookCategory);
            $em->flush();

            return $this->redirectToRoute('bookcategory_show', array('id' => $bookCategory->getId()));
        }

        return $this->render('bookcategory/new.html.twig', array(
            'bookCategory' => $bookCategory,
            'form' => $form->createView(),
            'request' => $request,
        ));
    }

    /**
     * Finds and displays a bookCategory entity.
     *
     * @Route("/{id}", name="bookcategory_show")
     * @Method("GET")
     */
    public function showAction(Request $request, BookCategory $bookCategory)
    {
        $deleteForm = $this->createDeleteForm($bookCategory);

        return $this->render('bookcategory/show.html.twig', array(
            'bookCategory' => $bookCategory,
            'delete_form' => $deleteForm->createView(),
            'request' => $request,
        ));
    }

    /**
     * Displays a form to edit an existing bookCategory entity.
     *
     * @Route("/{id}/edit", name="bookcategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BookCategory $bookCategory)
    {
        $bookCategory->setModifiedAt(new \DateTime('now'));
        $deleteForm = $this->createDeleteForm($bookCategory);
        $editForm = $this->createForm('AppBundle\Form\BookCategoryType', $bookCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bookcategory_edit', array('id' => $bookCategory->getId()));
        }

        return $this->render('bookcategory/edit.html.twig', array(
            'bookCategory' => $bookCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'request' => $request,
        ));
    }

    /**
     * Deletes a bookCategory entity.
     *
     * @Route("/{id}", name="bookcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BookCategory $bookCategory)
    {
        $form = $this->createDeleteForm($bookCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bookCategory);
            $em->flush();
        }

        return $this->redirectToRoute('bookcategory_index');
    }

    /**
     * Creates a form to delete a bookCategory entity.
     *
     * @param BookCategory $bookCategory The bookCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BookCategory $bookCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bookcategory_delete', array('id' => $bookCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
