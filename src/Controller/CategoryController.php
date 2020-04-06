<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractBaseController
{
    private $em;

    function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    /**
     * @Route("/categories", name="category_list", methods={"GET"})
     */
    public function list(CategoryRepository $categoryRepository) {
        $categories = $categoryRepository->findAll();

        return $this->json(
            $categories,
            Response::HTTP_OK,
            [],
            ['groups' => 'categories:details']
        );
    }
    /**
     * @Route("/categories/{id}", name="category_details", methods={"GET"})
     */
    public function detail(Category $category)
    {
        return $this->json(
        ['category' => $category],
        Response::HTTP_OK, 
        [],
        ['groups' => 'categories:details']
        );
    }
    /**
     * @Route("/categories", name="category_ajout", methods={"POST"})
     */
    public function create(
        Request $request
    ) {
        $data = json_decode($request->getContent(), true);
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
        $this->em->persist($category);
        $this->em->flush();

        return $this->json(
            $category,
            Response::HTTP_CREATED,
            [],
            ['groups' => 'categories:details']
        );
        }
        $errors = $this->getFormErrors($form); 
        return $this->json(
        $errors,
        Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * @Route("/categories/{id}", name="category_patch", methods={"PATCH"})
     */
    public function patch(Category $category, Request $request)
    {
        return $this->update($request, $category, false);
    }

    /**
     * @Route("/categories/{id}", name="category_put", methods={"PUT"})
     */
    public function put(Category $category, Request $request)
    {
        return $this->update($request, $category);
    }


    /**
     * @Route("/categories/{id}", name="category_suppression", methods={"DELETE"})
     */
    public function delete(Category $category)
    {
        $this->em->remove($category);
        $this->em->flush();

        return $this->json('ok');
    }

    private function update(
        Request $request,
        Category $category,
        bool $clearMissing = true
      ) {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(CategoryType::class, $category);
    
        $form->submit($data, $clearMissing);
    
        if ($form->isSubmitted() && $form->isValid()) {
          $this->em->flush();
    
          return $this->json($category,
          Response::HTTP_OK,
          [],
          ['groups' => 'categories:details']
        );
        }
    
        $errors = $this->getFormErrors($form);
        return $this->json(
          $errors,
          Response::HTTP_BAD_REQUEST
        );
      }
}

