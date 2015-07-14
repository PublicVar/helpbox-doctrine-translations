<?php

namespace HelpBox\Bundle\Entity;

use Doctrine\ORM\EntityRepository;

class CategorieRepository extends EntityRepository
{
    /**
     * Override the default findAll()
     */
    public function findAll()
    {
        $query = $this->createQueryBuilder('c')
            ->leftJoin('c.articles','a')
            ->addSelect('a')
            ->getQuery()
            ;
   

        return $query->getResult();
    }

}
