<?php

namespace HelpBox\Bundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use HelpBox\Bundle\Entity\Article;
use HelpBox\Bundle\Entity\Categorie;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadArticleData implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //Create 3 articles with translations in "de" and "en". The base locale is "fr"
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        
        $categorie = new Categorie();
        $categorie->setName('News');
        
        for ($i = 0; $i < 25; $i++) {

            $article = new Article;
            $title = 'My article '.$i.' fr';
            $article->setTranslatableLocale('fr');
            $article->setTitle($title);
            $article->setContent('content '.$i.' fr');
            $article->setCategorie($categorie);

            $repository->translate($article, 'title', 'de', 'my article'.$i.'  de')
                ->translate($article, 'content', 'de', 'content '.$i.' de')
                ->translate($article, 'title', 'en', 'my article '.$i.' en')
                ->translate($article, 'content', 'en', 'content '.$i.' en')
            ;

            $manager->persist($article);
            $manager->flush();

 
        }
    }

}
