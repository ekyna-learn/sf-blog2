<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthorController
 * @package App\Controller
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class AuthorController extends AbstractController
{
    /**
     * @Route("/authors", name="author_index")
     */
    public function index()
    {
        $authors = $this->authorRepository->findAll();

        return $this->render('Author/index.html.twig', [
            'list_authors' => $authors,
        ]);
    }

    /**
     * @Route("/authors/{slug}", name="author_show")
     */
    public function show($slug)
    {
        $author = $this->authorRepository->findOneBySlug($slug);

        $posts = $this->postRepository->findByAuthor($author);

        return $this->render('Author/show.html.twig', [
            'author' => $author,
            'posts' => $posts,
        ]);
    }

    public function menu()
    {
        return $this->render('Author/menu.html.twig', [
            'authors' => $this->authorRepository->findAll(),
        ]);
    }
}
