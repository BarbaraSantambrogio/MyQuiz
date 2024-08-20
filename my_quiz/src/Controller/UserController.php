<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EditPasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/homePage/edit/{id}', name: 'user.edit')]
    public function edit(User $user, Request $request, EntityManagerInterface $manager): Response
    {
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('homePage');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Changements bien enregistré');
            return $this->redirectToRoute('homePage');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/homePage/editPassword/{id}', name: 'userPassword.edit')]
    public function editPassword(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('homePage');
        }

        $form = $this->createForm(EditPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            dump($data); die;
            if (isset($data['plainPassword']) && $hasher->isPasswordValid($user, $data['plainPassword'])) {
                if ($data['newPassword'] === $data['confirmNewPassword']) {
                    $user->setPassword($hasher->hashPassword($user, $data['newPassword']));
                    $manager->persist($user);
                    $manager->flush();

                    $this->addFlash('success', 'Changements bien enregistré');
                    return $this->redirectToRoute('homePage');
                } else {
                    $this->addFlash('error', 'New password and confirmation do not match.');
                }
            } else {
                $this->addFlash('error', 'Current password is incorrect.');
            }
        }

        return $this->render('user/editPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}