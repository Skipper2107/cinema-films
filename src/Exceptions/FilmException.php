<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 10:53 AM
 */

namespace Skipper\Films\Exceptions;

use Skipper\Exceptions\DomainException;
use Skipper\Exceptions\Error;
use Throwable;

class FilmException extends DomainException
{
    public function __construct(string $message = '', array $context = [], Throwable $previous = null, int $code = 0)
    {
        parent::__construct($message, $context, $previous, $code);
    }

    protected function addInstantError(): ?Error
    {
        return new Error('Film error', 'internalError', 'film');
    }
}