<?php

declare(strict_types=1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the order entity type.
 */
final class OrderListBuilder extends SortableListBuilder
{
  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array
  {
    $header['id'] = array(
      'data' => $this->t('Order number'),
      'field' => 'id',
      'specifier' => 'id',
    );
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array
  {
    /** @var \Drupal\trip_admin\OrderInterface $entity */
    $row['id'] = $entity->toLink();
    return $row + parent::buildRow($entity);
  }
}
