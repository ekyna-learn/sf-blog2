<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthorController
 * @package App\Controller
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class AuthorController extends AbstractController
{
    public function index(): Response
    {
        $authors = $this->authorRepository->findAll();

        // TODO Rendu d'un template affichant la liste des auteurs.
    }

    public function show(string $slug): Response
    {
        $author = $this->authorRepository->findOneBySlug($slug);

        $posts = $this->postRepository->findByAuthor($author);

        // TODO Rendu d'un template affichant le détail de l'auteur, et la liste des articles (Post) associés.
    }
}
