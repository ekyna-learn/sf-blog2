<?php

namespace App\Repository;

use App\Entity\Author;

/**
 * Class AuthorRepository
 * @package App\Repository
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class AuthorRepository extends AbstractRepository
{
    const ENTRY = 'authors';

    /**
     * Finds one author by its id.
     *
     * @param int $id
     *
     * @return Author|null
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
     * Finds one author by its slug.
     *
     * @param string $slug
     *
     * @return Author|null
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
     * Finds all the authors.
     *
     * @return Author[]
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
     * @return Author
     */
    private function build(array $data)
    {
        if ($this->has($data['id'])) {
            /** @noinspection PhpIncompatibleReturnTypeInspection */
            return $this->get($data['id']);
        }

        $author = new Author($data['id']);
        $author
            ->setFirstName($data['first_name'])
            ->setLastName($data['last_name'])
            ->setBio($data['bio'])
            ->setSlug($data['slug']);

        $this->set($data['id'], $author);

        return $author;
    }
}
