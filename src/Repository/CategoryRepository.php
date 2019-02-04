<?php

namespace App\Repository;

use App\Entity\Category;

/**
 * Class CategoryRepository
 * @package App\Repository
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CategoryRepository extends AbstractRepository
{
    const ENTRY = 'categories';

    /**
     * Finds one category by its id.
     *
     * @param int $id
     *
     * @return Category|null
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
     * Finds one category by its slug.
     *
     * @param string $slug
     *
     * @return Category|null
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
     * Finds all the categories.
     *
     * @return Category[]
     */
    public function findAll()
    {
        try {
            $collection = self::getObjectData(self::ENTRY);
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
     * @return Category
     */
    private function build(array $data)
    {
        if ($this->has($data['id'])) {
            /** @noinspection PhpIncompatibleReturnTypeInspection */
            return $this->get($data['id']);
        }

        $category = new Category($data['id']);
        $category
            ->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setSlug($data['slug']);

        $this->set($data['id'], $category);

        return $category;
    }
}
