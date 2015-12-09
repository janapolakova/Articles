<?php

namespace JPCoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ArticleRepository
 *
 * @author Jana Polakova <jana.polakova@icloud.com>
 * @package JPCoreBundle\Repository
 */
class ArticleRepository extends EntityRepository {
    /**
     * Get all ordered by date created.
     *
     * @return array
     */
    public function getAllOrderedByDateCreated(){
        return $this->_em
            ->createQuery('SELECT a FROM JPCoreBundle:Article a ORDER BY a.dateCreated ASC')
            ->useQueryCache(true)
            ->getResult()
        ;
    }
}
