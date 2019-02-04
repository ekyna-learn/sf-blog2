<?php

namespace App\Controller;

/**
 * Class AuthorController
 * @package App\Controller
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class AuthorController extends AbstractController
{
    public function index()
    {
        $authors = $this->authorRepository->findAll();

        // TODO Rendu d'un template affichant la liste des auteurs.
    }

    public function show($slug)
    {
        $author = $this->authorRepository->findOneBySlug($slug);

        $posts = $this->postRepository->findByAuthor($author);

        // TODO Rendu d'un template affichant le détail de l'auteur, et la liste des articles (Post) associés.
    }
}
