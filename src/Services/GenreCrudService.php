<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 1:32 PM
 */

namespace Skipper\Films\Services;

use Skipper\Films\Entities\Genre;
use Skipper\Films\Repositories\GenreRepository;
use Skipper\Films\Requests\GenreRequest;

class GenreCrudService
{
    /**
     * @var GenreRepository
     */
    protected $genres;

    public function __construct(GenreRepository $genres)
    {
        $this->genres = $genres;
    }

    /**
     * @param GenreRequest $request
     * @return Genre
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function create(GenreRequest $request): Genre
    {
        $genre = new Genre($request->getName());

        $genre->setLocale($request->getLocale());
        $genre->setPublished(false);

        $this->genres->save($genre);

        return $genre;
    }

    /**
     * @param GenreRequest $request
     * @return Genre
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function update(GenreRequest $request): Genre
    {
        /** @var Genre $genre */
        $genre = $this->genres->find($request->getId());

        $genre
            ->setName($request->getName())
            ->setLocale($request->getLocale());

        $this->genres->save($genre);

        return $genre;
    }

    /**
     * @param GenreRequest $request
     * @return Genre
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function toggle(GenreRequest $request): Genre
    {
        /** @var Genre $genre */
        $genre = $this->genres->find($request->getId());

        $genre->setPublished($request->getPublished());

        $this->genres->save($genre);

        return $genre;
    }

    /**
     * @param GenreRequest $request
     * @return Genre
     * @throws \Skipper\Repository\Exceptions\EntityNotFoundException
     * @throws \Skipper\Repository\Exceptions\StorageException
     */
    public function delete(GenreRequest $request): Genre
    {
        /** @var Genre $genre */
        $genre = $this->genres->find($request->getId());

        $this->genres->delete($genre);

        return $genre;
    }
}