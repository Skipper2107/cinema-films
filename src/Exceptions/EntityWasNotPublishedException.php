<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/25/18
 * Time: 12:08 PM
 */

namespace Skipper\Films\Exceptions;

use Skipper\Exceptions\Error;
use Throwable;

class EntityWasNotPublishedException extends FilmException
{
    public function __construct(string $message = '', array $context = [], Throwable $previous = null, int $code = 0)
    {
        parent::__construct($message, $context, $previous, $code);
    }

    protected function addInstantError(): ?Error
    {
        return new Error('Entity was not published', 'badRequest', 'film');
    }
}