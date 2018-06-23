<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/22/18
 * Time: 2:16 PM
 */

namespace Skipper\Films\Services\Filters;

use Skipper\Search\FilterInterface;

class NameFilter implements FilterInterface
{

    /**
     * @param array $criteria
     * @param $value
     * @return array
     */
    public function applyFilter(array $criteria, $value): array
    {
        $criteria['filter']['name']['value'] = $value;

        return $criteria;
    }

    /**
     * @return array
     */
    public function getValidationRules(): array
    {
        return [
            'string',
        ];
    }
}