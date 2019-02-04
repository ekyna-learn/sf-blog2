<?php

namespace App\Controller;

/**
 * Class TestController
 * @package App\Controller
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class PostController extends AbstractController
{
    public function show($slug)
    {
        $post = $this->postRepository->findOneBySlug($slug);

        // TODO Rendu d'un template affichant le détail de l'article (post)
    }
}
