<?php

namespace JPCoreBundle\Service;

use Doctrine\ORM\EntityManager;
use JPCoreBundle\Entity\Article;
use JPCoreBundle\Repository\ArticleRepository;

/**
 * Class ArticleService
 *
 * @author Jana Polakova <jana.polakova@icloud.com>
 * @package JP\CoreBundle\Service
 */
class ArticleService {
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * Constructor.
     *
     * @param EntityManager $entityManager
     * @param ArticleRepository $articleRepository
     */
    public function __construct(EntityManager $entityManager, ArticleRepository $articleRepository){
        $this->em = $entityManager;
        $this->articleRepository = $articleRepository;
    }

    /**
     * Get all articles.
     *
     * @return array
     */
    public function getAll(){
        return $this->articleRepository->getAllOrderedByDateCreated();
    }

    /**
     * Save article.
     *
     * @param Article $article
     */
    public function save(Article $article){
        if ($article->getId() === null){
            $this->em->persist($article);
        }

        $article->setDateLastUpdate(new \DateTime);
        $this->em->flush();
    }

    /**
     * Delete article.
     *
     * @param Article $article
     */
    public function delete(Article $article){
        $this->em->remove($article);
        $this->em->flush();
    }
}
