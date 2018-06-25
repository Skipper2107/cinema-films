<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/25/18
 * Time: 12:08 PM
 */

namespace Skipper\Films\Exceptions;

use Skipper\Exceptions\HttpCode;
use Skipper\Repository\Contracts\Entity;
use Throwable;

class EntityWasNotPublishedException extends FilmException
{
    public function __construct(Entity $entity, array $context = [], Throwable $previous = null)
    {
        parent::__construct(
            HttpCode::forbidden(),
            'Entity was not published: ' . get_class($entity),
            array_merge($context, [
                'entity' => $entity,
            ]),
            $previous
        );
    }
}