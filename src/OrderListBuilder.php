<?php

declare(strict_types=1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the order entity type.
 */
final class OrderListBuilder extends EntityListBuilder
{

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array
  {
    $header['id'] = $this->t('Order number');
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
