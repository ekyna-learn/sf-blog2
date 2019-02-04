<?php

namespace App\Repository;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Post;

/**
 * Class PostRepository
 * @package App\Repository
 * @post  Etienne Dauvergne <contact@ekyna.com>
 */
class PostRepository extends AbstractRepository
{
    const ENTRY = 'posts';

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var AuthorRepository
     */
    private $authorRepository;


    /**
     * Constructor.
     *
     * @param CategoryRepository $categoryRepository
     * @param AuthorRepository   $authorRepository
     */
    public function __construct(CategoryRepository $categoryRepository, AuthorRepository $authorRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * Finds one post by its id.
     *
     * @param int $id
     *
     * @return Post|null
     */
    public function find(int $id)
    {
        try {
            $data = self::getObjectDataById(self::ENTRY, $id);
        } catch (\UnexpectedValueException $e) {
            return null;
        }

        return $this->build($data);
    }

    /**
     * Finds one post by its slug.
     *
     * @param string $slug
     *
     * @return Post|null
     */
    public function findOneBySlug(string $slug)
    {
        try {
            $data = self::getObjectDataByKeyValue(self::ENTRY, 'slug', $slug);
        } catch (\UnexpectedValueException $e) {
            return null;
        }

        return $this->build($data);
    }

    /**
     * Finds posts by category.
     *
     * @param Category $category
     *
     * @return Post[]
     */
    public function findByCategory(Category $category)
    {
        try {
            $collection = self::getObjectDataByKeyValue(self::ENTRY, 'category', $category->getId(), false);
        } catch (\UnexpectedValueException $e) {
            return [];
        }

        return array_map(function($data) {
            return $this->build($data);
        }, $collection);
    }

    /**
     * Finds posts by author.
     *
     * @param Author $author
     *
     * @return Post[]
     */
    public function findByAuthor(Author $author)
    {
        try {
            $collection = self::getObjectDataByKeyValue(self::ENTRY, 'author', $author->getId(), false);
        } catch (\UnexpectedValueException $e) {
            return [];
        }

        return array_map(function($data) {
            return $this->build($data);
        }, $collection);
    }

    /**
     * Builds the category.
     *
     * @param array $data
     *
     * @return Post
     */
    private function build(array $data)
    {
        if ($this->has($data['id'])) {
            /** @noinspection PhpIncompatibleReturnTypeInspection */
            return $this->get($data['id']);
        }

        $post = new Post($data['id']);
        $post
            ->setTitle($data['title'])
            ->setCategory($this->categoryRepository->find($data['category']))
            ->setAuthor($this->authorRepository->find($data['author']))
            ->setDate(new \DateTime($data['date']))
            ->setContent($data['content'])
            ->setImage($data['image'])
            ->setSlug($data['slug']);

        $this->set($data['id'], $post);

        return $post;
    }
}
