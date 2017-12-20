<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PaymentCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Paymentcategory controller.
 *
 * @Route("paymentcategory/{_locale}")
 */
class PaymentCategoryController extends Controller
{
    /**
     * Lists all paymentCategory entities.
     *
     * @Route("/", name="paymentcategory_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $paymentCategories = $em->getRepository('AppBundle:PaymentCategory')->findAll();

        return $this->render('paymentcategory/index.html.twig', array(
            'paymentCategories' => $paymentCategories,
            'request' => $request,
        ));
    }

    /**
     * Creates a new paymentCategory entity.
     *
     * @Route("/new", name="paymentcategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $paymentCategory = new Paymentcategory();
        $form = $this->createForm('AppBundle\Form\PaymentCategoryType', $paymentCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paymentCategory);
            $em->flush();

            return $this->redirectToRoute('paymentcategory_show', array('id' => $paymentCategory->getId()));
        }

        return $this->render('paymentcategory/new.html.twig', array(
            'paymentCategory' => $paymentCategory,
            'form' => $form->createView(),
            'request' => $request,
        ));
    }

    /**
     * Finds and displays a paymentCategory entity.
     *
     * @Route("/{id}", name="paymentcategory_show")
     * @Method("GET")
     */
    public function showAction(Request $request, PaymentCategory $paymentCategory)
    {
        $deleteForm = $this->createDeleteForm($paymentCategory);

        return $this->render('paymentcategory/show.html.twig', array(
            'paymentCategory' => $paymentCategory,
            'delete_form' => $deleteForm->createView(),
            'request' => $request,
        ));
    }

    /**
     * Displays a form to edit an existing paymentCategory entity.
     *
     * @Route("/{id}/edit", name="paymentcategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PaymentCategory $paymentCategory)
    {
        $paymentCategory->setModifiedAt(new \DateTime('now'));
        $deleteForm = $this->createDeleteForm($paymentCategory);
        $editForm = $this->createForm('AppBundle\Form\PaymentCategoryType', $paymentCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paymentcategory_edit', array('id' => $paymentCategory->getId()));
        }

        return $this->render('paymentcategory/edit.html.twig', array(
            'paymentCategory' => $paymentCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'request' => $request,
        ));
    }

    /**
     * Deletes a paymentCategory entity.
     *
     * @Route("/{id}", name="paymentcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PaymentCategory $paymentCategory)
    {
        $form = $this->createDeleteForm($paymentCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paymentCategory);
            $em->flush();
        }

        return $this->redirectToRoute('paymentcategory_index');
    }

    /**
     * Creates a form to delete a paymentCategory entity.
     *
     * @param PaymentCategory $paymentCategory The paymentCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PaymentCategory $paymentCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paymentcategory_delete', array('id' => $paymentCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
