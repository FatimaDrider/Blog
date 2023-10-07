<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class Blog extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    
    for($i=0; $i<10; $i++)
    {
        $blog = new BlogPost();
            $blog->setTitle('Blog '.$i);
            $blog->setContent('Blog 4'.$i);
            $blog->setAuthor('Blog 3'. $i);
            $blog->setCreatedAt(new \DateTime());
        
            $manager->persist($blog);

    }
            $blog = new BlogPost();
            $blog->setTitle('Blog 2 ');
            $blog->setContent('Blog 4');
            $blog->setAuthor('Blog 3');
            $blog->setCreatedAt(new \DateTime());
        
            $manager->persist($blog);

            $comment = new Comment();
            $comment->setAuthor('Comment 1');
            $comment->setContent('Comment 2');
            $comment->setCreatedAt(new \DateTime());
            $comment->setBlog($blog);
            $manager->persist($comment);
           
        
        
        $manager->flush();
    }
}
