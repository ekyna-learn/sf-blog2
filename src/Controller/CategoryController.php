<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="category_index")
     */
    public function index()
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('Category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categories/{slug}", name="category_show")
     */
    public function show($slug)
    {
        $category = $this->categoryRepository->findOneBySlug($slug);

        $posts = $this->postRepository->findByCategory($category);

        return $this->render('Category/show.html.twig', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function menu()
    {
        return $this->render('Category/menu.html.twig', [
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }
}
