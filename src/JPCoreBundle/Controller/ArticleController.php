<?php

namespace JPCoreBundle\Controller;

use Doctrine\DBAL\DBALException;
use JPCoreBundle\Entity\Article;
use JPCoreBundle\Form\ArticleForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ArticleController
 *
 * @author Jana Polakova <jana.polakova@icloud.com>
 * @package JP\CoreBundle\Controller
 */
class ArticleController extends Controller {
    /**
     * Index action.
     *
     * @Route("/", name="article_index")
     * @Template("JPCoreBundle::Article/index.html.twig")
     * @Method("GET")
     */
    public function indexAction(){
        return ['articles' => $this->get('service.article')->getAll()];
    }

    /**
     * Create action.
     *
     * @Route("/new-article", name="article_create")
     * @Template("JPCoreBundle::Article/create.html.twig")
     * @Method("GET")
     */
    public function createAction(){
        return ['form' => $this->createCreateForm(new Article())->createView()];
    }

    /**
     * Create process action.
     *
     * @Route("/new-article", name="article_createProcess")
     * @Template("JPCoreBundle::Article/create.html.twig")
     * @Method("POST")
     */
    public function createProcessAction(Request $request){
        $article = new Article();

        $createForm = $this->createCreateForm($article);
        $createForm->handleRequest($request);

        $message = [];
        if ($createForm->isValid()){
            try {
                $this->get('service.article')->save($article);
                $this->get('session')->getFlashBag()->add('success', 'New article was added.');

                return $this->redirect($this->generateUrl('article_index'));
            } catch (DBALException $e){
                $message = ['type' => 'danger', 'message' => 'Article couldn\'t be saved.'];
            }
        }

        return [
            'form' => $createForm->createView(),
            'message' => $message,
        ];
    }

    /**
     * Update action.
     *
     * @Route("/edit-article/{id}", requirements={"id" = "\d+"}, name="article_update")
     * @Template("JPCoreBundle::Article/update.html.twig")
     * @Method("GET")
     */
    public function updateAction(Article $article = null){
        if($article === null){
            $this->get('session')->getFlashbag()->add('danger', 'Article doesn\'t exist.');
            return $this->redirect($this->generateUrl('article_index'));
        }

        return [
            'form' => $this->createUpdateForm($article)->createView(),
            'article' => $article,
        ];
    }

    /**
     * Update process action.
     *
     * @Route("/edit-article/{id}", requirements={"id" = "\d+"}, name="article_updateProcess")
     * @Template("JPCoreBundle::Article/update.html.twig")
     * @Method("POST")
     */
    public function updateProcessAction(Request $request, Article $article = null){
        $flashBag = $this->get('session')->getFlashBag();

        if($article === null){
            $this->get('session')->getFlashbag()->add('danger', 'Article doesn\'t exist.');
            return $this->redirect($this->generateUrl('article_index'));
        }

        $updateForm = $this->createUpdateForm($article);
        $updateForm->handleRequest($request);

        $message = [];
        if ($updateForm->isValid()){
            try {
                $this->get('service.article')->save($article);
                $flashBag->add('success','Article was saved.');

                return $this->redirect($this->generateUrl('article_index'));
            } catch(DBALException $e){
                $message = ['type' => 'danger', 'message' => 'Article couldn\'t be saved.'];
            }
        }

        return [
            'article' => $article,
            'form' => $updateForm->createView(),
            'message' => $message,
        ];
    }

    /**
     * Display action.
     *
     * @Route("/display/{id}", name="article_display")
     * @Template("JPCoreBundle::Article/display.html.twig")
     * @Method("GET")
     */
    public function showAction(Article $article = null){
        if($article === null){
            $this->get('session')->getFlashbag()->add('danger', 'Article doesn\'t exist.');
            return $this->redirect($this->generateUrl('article_index'));
        }

        return ['article' => $article];
    }

    /**
     * Delete action.
     *
     * @Route("/delete-article/{id}", requirements={"id" = "\d+"}, name="article_delete")
     * @Method("GET")
     */
    public function deleteAction(Article $article = null){
        $flashBag = $this->get('session')->getFlashbag();
        $redirect = $this->redirect($this->generateUrl('article_index'));

        if($article === null){
            $this->get('session')->getFlashbag()->add('danger', 'Article doesn\'t exist.');
            return $redirect;
        }

        try {
            $this->get('service.article')->delete($article);
            $flashBag->add('success', 'Article was deleted.');
        } catch(DBALException $e){
            $flashBag->add('danger', 'Article couldn\'t be deleted.');
        }

        return $redirect;
    }

    /**
     * Create create form.
     *
     * @param Article $article
     * @return \Symfony\Component\Form\Form
     */
    public function createCreateForm(Article $article){
        return $this->createForm(new ArticleForm(), $article, [
            'action' => $this->generateUrl('article_createProcess'),
            'method' => 'POST',
        ]);
    }

    /**
     * Create update form.
     *
     * @param Article $article
     * @return \Symfony\Component\Form\Form
     */
    public function createUpdateForm(Article $article){
        return $this->createForm(new ArticleForm(), $article, [
            'action' => $this->generateUrl('article_updateProcess', ['id' => $article->getId()]),
            'method' => 'POST',
        ]);
    }
}