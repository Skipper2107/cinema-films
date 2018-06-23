<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 1:57 PM
 */

namespace Skipper\Films\Services;

use Skipper\Repository\Contracts\Repository;
use Skipper\Search\AbstractSeeker;

abstract class MovieSeeker extends AbstractSeeker
{
    /**
     * @var string
     */
    protected $locale;

    public function __construct(Repository $driver, string $locale)
    {
        parent::__construct($driver);
        $this->locale = $locale;
    }


    protected function getInitialQuery(): array
    {
        $query = parent::getInitialQuery();

        $query['filter']['locale']['value'] = $this->locale;

        return $query;
    }
}