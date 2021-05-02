<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseController;

/**
 * Class AbstractController
 * @package App\Controller
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class AbstractController extends BaseController
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var AuthorRepository
     */
    protected $authorRepository;

    /**
     * @var PostRepository
     */
    protected $postRepository;


    /**
     * Constructor.
     *
     * @param CategoryRepository $categoryRepository
     * @param AuthorRepository   $authorRepository
     * @param PostRepository     $postRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        AuthorRepository $authorRepository,
        PostRepository $postRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
        $this->postRepository = $postRepository;
    }
}
