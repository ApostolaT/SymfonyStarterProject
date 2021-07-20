<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user/{id}", methods={"GET"}, name="get_user")
     */
    public function myGetUser(Request $request, string $id): Response
    {
        return new Response();
    }

    /**
     * @Route("/api/user/{id}", methods={"POST"}, name="post_user")
     */
    public function CreateUser(Request $request, string $id): Response
    {
        return new Response();
    }
}