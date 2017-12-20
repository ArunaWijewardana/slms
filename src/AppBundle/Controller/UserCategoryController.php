<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Usercategory controller.
 *
 * @Route("usercategory/{_locale}")
 */
class UserCategoryController extends Controller
{
    /**
     * Lists all userCategory entities.
     *
     * @Route("/", name="usercategory_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $userCategories = $em->getRepository('AppBundle:UserCategory')->findAll();

        return $this->render('usercategory/index.html.twig', array(
            'userCategories' => $userCategories,
            'request' => $request,
        ));
    }

    /**
     * Creates a new userCategory entity.
     *
     * @Route("/new", name="usercategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userCategory = new Usercategory();

        $form = $this->createForm('AppBundle\Form\UserCategoryType', $userCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userCategory);
            $em->flush();

            return $this->redirectToRoute('usercategory_show', array('id' => $userCategory->getId()));
        }

        return $this->render('usercategory/new.html.twig', array(
            'userCategory' => $userCategory,
            'form' => $form->createView(),
            'request' => $request,
        ));
    }

    /**
     * Finds and displays a userCategory entity.
     *
     * @Route("/{id}", name="usercategory_show")
     * @Method("GET")
     */
    public function showAction(Request $request, UserCategory $userCategory)
    {
        $deleteForm = $this->createDeleteForm($userCategory);

        return $this->render('usercategory/show.html.twig', array(
            'userCategory' => $userCategory,
            'delete_form' => $deleteForm->createView(),
            'request' => $request,
        ));
    }

    /**
     * Displays a form to edit an existing userCategory entity.
     *
     * @Route("/{id}/edit", name="usercategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserCategory $userCategory)
    {
        $userCategory->setModifiedAt(new \DateTime('now'));
        $deleteForm = $this->createDeleteForm($userCategory);
        $editForm = $this->createForm('AppBundle\Form\UserCategoryType', $userCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usercategory_edit', array('id' => $userCategory->getId()));
        }

        return $this->render('usercategory/edit.html.twig', array(
            'userCategory' => $userCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'request' => $request,
        ));
    }

    /**
     * Deletes a userCategory entity.
     *
     * @Route("/{id}", name="usercategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserCategory $userCategory)
    {
        $form = $this->createDeleteForm($userCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userCategory);
            $em->flush();
        }

        return $this->redirectToRoute('usercategory_index');
    }

    /**
     * Creates a form to delete a userCategory entity.
     *
     * @param UserCategory $userCategory The userCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserCategory $userCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usercategory_delete', array('id' => $userCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
