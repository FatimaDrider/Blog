<?php

namespace App\Controller;

use ApiPlatform\Api\UrlGeneratorInterface;
use App\Entity\Comment;
use App\Repository\BlogPostRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
#[Route('/api')]
class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    function getComment(CommentRepository $commentRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $comments = $commentRepository->findAll();
        $jsonCommentList = $serializerInterface->serialize($comments, 'json', );
        return new JsonResponse($jsonCommentList, 200, [], true);
    }
    #[Route('/create_comment', name: 'app_comment_id')] 
    public function createComment(CommentRepository $commentRepository, SerializerInterface $serializerInterface, Request $request, UrlGeneratorInterface $urlGenerator,BlogPostRepository $blogPostRepository, EntityManagerInterface $em): JsonResponse
    {
        $comment = $serializerInterface->deserialize($request->getContent(), Comment::class, 'json');
        $content = $request->toArray();
        $idBlog = $content['idblog'] ?? -1;
        $comment->setBlog($blogPostRepository->find($idBlog));
        $em->persist($comment);
        $em->flush();

        $jsonCommentList = $serializerInterface->serialize($comment, 'json', );
        return new JsonResponse($jsonCommentList, 200, [], true);
            
    }

        
}
