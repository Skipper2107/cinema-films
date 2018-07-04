<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 6/27/18
 * Time: 3:54 PM
 */

namespace Skipper\Films\Repositories;

use Skipper\Repository\DataTransferObjects\Filter;

trait CypherHelper
{
    /**
     * @param string $entity
     * @param Filter[] $filters
     * @return string
     */
    protected function applyFilters(string $entity, array $filters): string
    {
        foreach ($filters as $filter) {
            $f[] = $this->formatCondition($entity, $filter);
        }

        return sprintf('WHERE %s', implode(', ', $f ?? []));
    }

    /**
     * @param string $entity
     * @param Filter $filter
     * @return string
     */
    protected function formatCondition(string $entity, Filter $filter): string
    {
        switch ($filter->getOperator()) {
            case 'in':
                return sprintf('%s.%s IN [%s]', $entity, $filter->getColumn(), implode(',', $filter->getValue()));
            case '!in':
                return sprintf('%s.%s NOT IN [%s]', $entity, $filter->getColumn(), implode(',', $filter->getValue()));
            case 'like':
                return sprintf('%s.%s CONTAINS %s', $entity, $filter->getColumn(), $filter->getValue());
            case '!like':
                return sprintf('%s.%s NOT CONTAINS %s', $entity, $filter->getColumn(), $filter->getValue());
            case '!=':
                if (null === $filter->getValue()) {
                    return sprintf('%s.%s IS NOT NULL', $entity, $filter->getColumn());
                }
                return sprintf('%s.%s <> %s', $entity, $filter->getColumn(), $filter->getValue());
            case '=':
                if (null === $filter->getValue()) {
                    return sprintf('%s.%s IS NULL', $entity, $filter->getColumn());
                }
                return sprintf('%s.%s = %s', $entity, $filter->getColumn(), $filter->getValue());
            default:
                return sprintf('%s.%s %s %s', $entity, $filter->getColumn(), $filter->getOperator(),
                    $filter->getValue());
        }
    }

    /**
     * @param string $entity
     * @param array $orders
     * @return string
     */
    protected function applyOrders(string $entity, array $orders): string
    {
        $query = '';
        foreach ($orders as $column => $order) {
            $queries[] = sprintf('%s.%s %s', $entity, $column, strtoupper($order));
        }

        $queries = $queries ?? [];
        if (0 !== count($queries)) {
            $query = sprintf('ORDER BY %s', reset($queries));
        }

        return $query;
    }
}