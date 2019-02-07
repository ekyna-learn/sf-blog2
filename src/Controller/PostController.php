<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package App\Controller
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class PostController extends AbstractController
{
    /**
     * @Route("/{slug}", name="post_show")
     */
    public function show($slug)
    {
        $post = $this->postRepository->findOneBySlug($slug);

        return $this->render('Post/show.html.twig', [
            'post' => $post,
        ]);
    }
}
