<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
#[Route('/api')]
class BlogController extends AbstractController
{
    #[Route('/blogs', name: 'app_blog', methods: ['GET'])]
    public function getAllBlogs(BlogPostRepository $blogPostRepository, SerializerInterface $serializer): JsonResponse
    {

        $blogPosts = $blogPostRepository->findAll();
        $jsonbBlogList = $serializer->serialize($blogPosts, 'json', ['groups' => 'blog']);
        return new JsonResponse($jsonbBlogList, 200, [], true);
    }

    #[Route('/blogs/{id}', name: 'app_blog_post')]
    public function getDetailBlog(int $id, BlogPostRepository $blogPostRepository, SerializerInterface $serializer): JsonResponse
    {
        $blogPost = $blogPostRepository->find($id);
        $jsonbBlogList = $serializer->serialize($blogPost, 'json', ['groups' => 'blog']);
        return new JsonResponse($jsonbBlogList, 200, [], true);
    }

    #[Route('/create_blog', name: 'create_blog', methods: ['POST'])]
    public function createBlog(Request $request ,BlogPostRepository $blogPostRepository, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
    {
        $json = $request->getContent();
        
        $blogPost = $serializer->deserialize($json, BlogPost::class, 'json');
        
    
        $em->persist($blogPost);
        $em->flush();
        return new JsonResponse([
            'status' => 'ok',
            'id' => $blogPost->getId()
        ], 201
        );
    }

    #[Route('/update_blog/{id}', name: 'update_blog', methods: ['PUT'])]
    public function updateBlog(BlogPost $blogPost, Request $request, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
    {
        $json = $request->getContent();
        $blogPost = $serializer->deserialize($json, BlogPost::class, 'json', ['object_to_populate' => $blogPost]);
        $em->persist($blogPost);
        $em->flush();
        return new JsonResponse(null, 204);
    }

    #[Route('/delete_blog/{id}', name: 'delete_blog', methods: ['DELETE'])]
    public function deleteBlog(BlogPost $blogPost, EntityManagerInterface $em): JsonResponse{
        $em->remove($blogPost);
        $em->flush();
        return new JsonResponse(null, 204);
    }
}
