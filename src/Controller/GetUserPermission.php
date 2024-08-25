<?php

namespace App\Controller;

use App\Repository\UserRoleRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class GetUserPermission extends AbstractController
{
    public function __construct(
        private JWTTokenManagerInterface $JWTTokenManager,
        private UserRoleRepository $userRoleRepository
    ) {
    }
    public function __invoke():Response
    {
        $result = $this->userRoleRepository->findByUserId($this->getUser()->getId());
        $permissions = [];
        foreach ($result as $item) {
            foreach ($item->getRoles() as $role) {
                foreach ($role->getPermissions() as $permission) {
                    $permissions[$permission->getName()] = $role->getName();
                }
            }
        }
        $permissions = array_unique($permissions);
        return $this->json($permissions);
    }
}
