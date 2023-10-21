<?php

declare(strict_types=1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a sortable list controller.
 */
abstract class SortableListBuilder extends EntityListBuilder
{

    protected function getEntityIds()
    {
        $query = \Drupal::entityQuery($this->entityTypeId);
        $request = \Drupal::request();

        $order = $request->get('order');
        if ($order) {
            $sort = $request->get('sort');
            foreach ($this->buildHeader() as $name => $field) {
                if (is_array($field) && $field['data'] == $order) {
                    $header = [$name => $field + [
                        'specifier' => $name,
                        'sort' => $sort ?? $field['sort'] ?? 'asc',
                    ]];
                }
            }
            if ($header) {
                $query->tableSort($header);
            }
        } else {
            $query->sort('id', 'asc');
        }

        return $query->accessCheck()->execute();
    }
}
