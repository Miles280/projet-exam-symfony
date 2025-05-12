<?php

namespace App\Controller;

use App\Entity\Power;
use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/role')]
final class GameRoleController extends AbstractController
{
    #[Route('/', name: 'app_game_role_index', methods: ['GET'])]
    public function index(RoleRepository $roleRepository): Response
    {
        $roles = $roleRepository->findAll();

        return $this->render('gameRole/index.html.twig', [
            'roles' => $roles,
        ]);
    }

    #[Route('/admin/new', name: 'app_game_role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $role = new Role();

        $role->addPower(new Power()); // Ajoute un pouvoir vide par défaut pour l’affichage du formulaire

        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $index = 1;
            foreach ($role->getPowers() as $power) {
                $power->setPosition($index++);
            }

            $entityManager->persist($role);
            $entityManager->flush();

            return $this->redirectToRoute('app_game_role_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gameRole/new.html.twig', [
            'role' => $role,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_role_show', methods: ['GET'])]
    public function show(Role $role): Response
    {
        return $this->render('gameRole/show.html.twig', [
            'role' => $role,
        ]);
    }

    #[Route('/admin/{id}/edit', name: 'app_game_role_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Role $role, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_game_role_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gameRole/edit.html.twig', [
            'role' => $role,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_role_delete', methods: ['POST'])]
    public function delete(Request $request, Role $role, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $role->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($role);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_game_role_index', [], Response::HTTP_SEE_OTHER);
    }
}
