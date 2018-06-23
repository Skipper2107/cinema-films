<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/20/18
 * Time: 10:53 AM
 */

namespace Skipper\Films\Exceptions;

use Skipper\Exceptions\DomainException;
use Skipper\Exceptions\HttpCode;
use Throwable;

class FilmException extends DomainException
{
    public function __construct(HttpCode $code, string $message = '', array $context = [], Throwable $previous = null)
    {
        if (false === empty($message)) {
            $message = ':' . $message;
        }
        parent::__construct($code, 'FilmError' . $message, $context, $previous);
    }
}