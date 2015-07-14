<?php

namespace HelpBox\Bundle\Entity;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    /**
     * Override the default findAll()
     */
    public function findAll()
    {
        $query = $this->createQueryBuilder('a')
            ->getQuery()
            ;
        //prevent executing a query for every translated field
        $query->setHint(
            \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getResult();
    }

}
