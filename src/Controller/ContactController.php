<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="list_contacts")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository('App\Entity\Contact');
        $contacts = $repo->findAll();

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/add", name="add_contact")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact, [
            'action' => $this->generateUrl('add_contact'),
            'attr' => ['class' => 'add_form']
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('list_contacts');
        }

        return $this->render('contact/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update", name="update_contact")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact, [
            'action' => $this->generateUrl('update_contact'),
            'attr' => ['class' => 'update_form']
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            $contactToUpdate = $entityManager->getRepository(Contact::class)->find($form->get('id')->getData());

            $contactToUpdate->setLastName($contact->getLastName());
            $contactToUpdate->setFirstName($contact->getFirstName());
            $contactToUpdate->setPhone($contact->getPhone());
            $contactToUpdate->setEmail($contact->getEmail());

            $entityManager->persist($contactToUpdate);
            $entityManager->flush();

            return $this->redirectToRoute('list_contacts');
        }

        return $this->render('contact/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_contact")
     * @param $id
     * @return Response
     */
    public function delete($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contact = $entityManager->getRepository(Contact::class)->find($id);

        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('list_contacts');
    }
}
