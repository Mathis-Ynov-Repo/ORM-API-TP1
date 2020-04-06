<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;

use App\Repository\ArticleRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractBaseController
{
    private $em;

    function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    // CRUD


    /**
     * @Route("/articles", name="article_list", methods={"GET"})
     */
    public function list(ArticleRepository $articleRepository) {
        $articles = $articleRepository->findAll();

        return $this->json(
            $articles,
            Response::HTTP_OK,
            [],
            ['groups' => 'articles:details']
        );
    }

    /**
     * @Route("/articles/{id}", name="article_details", methods={"GET"})
     */
    public function detail(Article $article)
    {
        return $this->json(
        ['article' => $article],
        Response::HTTP_OK, 
        [],
        ['groups' => 'articles:details']
        );
    }
    /**
     * @Route("/articles", name="article_ajout", methods={"POST"})
     */
    public function create(
        Request $request
    ) {
        $data = json_decode($request->getContent(), true);
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
        $this->em->persist($article);
        $this->em->flush();

        return $this->json(
            $article,
            Response::HTTP_CREATED,
            [],
            ['groups' => 'articles:details']
        );
        }
        $errors = $this->getFormErrors($form); 
        return $this->json(
        $errors,
        Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * @Route("/articles/{id}", name="article_patch", methods={"PATCH"})
     */
    public function patch(Article $article, Request $request)
    {
        return $this->update($request, $article, false);
    }

    /**
     * @Route("/articles/{id}", name="article_put", methods={"PUT"})
     */
    public function put(Article $article, Request $request)
    {
        return $this->update($request, $article);
    }


    /**
     * @Route("/articles/{id}", name="article_suppression", methods={"DELETE"})
     */
    public function delete(Article $article)
    {
        $this->em->remove($article);
        $this->em->flush();

        return $this->json('ok');
    }

    //CUSTOM ENDPOINTS


    /**
     * @Route("/articles-trending", name="articles_trending", methods={"GET"})
     */
    public function listTrending(ArticleRepository $articleRepository) {
        $articles = $articleRepository->findBy(['trending' => true]);

        return $this->json(
            $articles,
            Response::HTTP_OK,
            [],
            ['groups' => 'articles:details']
        );
    }

    /**
     * @Route("articles-category/{category}", name="articles_category", methods={"GET"})
     */
    public function listCategory(ArticleRepository $articleRepository, Category $category) {
        $articles = $articleRepository->findBy(['category' => $category]);

        return $this->json(
            $articles,
            Response::HTTP_OK,
            [],
            ['groups' => 'articles:details']
        );
    }


    private function update(
        Request $request,
        Article $article,
        bool $clearMissing = true
      ) {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(ArticleType::class, $article);
    
        $form->submit($data, $clearMissing);
    
        if ($form->isSubmitted() && $form->isValid()) {
          $this->em->flush();
    
          return $this->json($article,
          Response::HTTP_OK,
          [],
          ['groups' => 'articles:details']
        );
        }
    
        $errors = $this->getFormErrors($form);
        return $this->json(
          $errors,
          Response::HTTP_BAD_REQUEST
        );
      }

}

