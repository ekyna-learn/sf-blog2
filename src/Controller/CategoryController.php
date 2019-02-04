<?php

namespace App\Controller;

/**
 * Class CategoryController
 * @package App\Controller
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CategoryController extends AbstractController
{
    public function index()
    {
        $categories = $this->categoryRepository->findAll();

        // TODO Rendu d'un template affichant la liste des catégories.
    }

    public function show($slug)
    {
        $category = $this->categoryRepository->findOneBySlug($slug);

        $posts = $this->postRepository->findByCategory($category);

        // TODO Rendu d'un template affichant le détail de la catégorie, et la liste des articles (Post) associés.
    }
}
