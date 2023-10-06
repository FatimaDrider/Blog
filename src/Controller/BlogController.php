<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog', methods: ['GET'])]
    public function getBlog(BlogPostRepository $blogPostRepository, SerializerInterface $serializer): JsonResponse
    {

        $blogPosts = $blogPostRepository->findAll();
        $jsonbBlogList = $serializer->serialize($blogPosts, 'json');
        return new JsonResponse($jsonbBlogList, 200, [], true);
    }

    #[Route('/blog/{id}', name: 'app_blog_post')]
    public function post(int $id, BlogPostRepository $blogPostRepository, SerializerInterface $serializer): JsonResponse
    {
        $blogPost = $blogPostRepository->find($id);
        $jsonbBlogList = $serializer->serialize($blogPost, 'json');
        return new JsonResponse($jsonbBlogList, 200, [], true);
    }
}
