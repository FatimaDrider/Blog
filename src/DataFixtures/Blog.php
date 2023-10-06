<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class Blog extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    
        for($i=0;$i<=10;$i++)
        {
            $blog = new BlogPost();
            $blog->setTitle('Blog '.$i);
            $blog->setContent('Blog '.$i);
            $blog->setAuthor('Blog '.$i);
            $blog->setCreatedAt(new \DateTime());
            $manager->persist($blog);
        }
        // $manager->persist($product);

        $manager->flush();
    }
}
