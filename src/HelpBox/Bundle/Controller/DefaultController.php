<?php

namespace HelpBox\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HelpBox\Bundle\Entity\Article;

class DefaultController extends Controller
{

    /**
     * @Route("/{_locale}/doctrine-translations", name="helpbox_doctrine_translations",defaults={"_locale" = "fr"})
     */
    public function doctrineTranslationAction()
    {
        $articleRepo = $this->getDoctrine()->getManager()->getRepository('HelpBoxBundle:Article');
        
        $articles = $articleRepo->findAll();
        
        // List all titles
        $titles = [];
        foreach($articles as $article){
            $titles[] = $article->getTitle();
        }

        //create a form listing only the titles
        $form = $this->createFormBuilder($articles)
            ->add('title', 'choice',array('choices'=>$titles))
            ->getForm()
        ;

        return $this->render('HelpBoxBundle:Default:index.html.twig',array('form'=>$form->createView()));
    }

}
