<?php

declare(strict_types=1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the stop entity type.
 */
final class StopListBuilder extends EntityListBuilder
{

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array
  {
    $header['id'] = $this->t('ID');
    $header['postal_code'] = $this->t('Postal code');
    $header['house_number'] = $this->t('House number');
    $header['delivered'] = $this->t('Status');
    $header['order_id'] = $this->t('Order');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array
  {
    /** @var \Drupal\trip_admin\StopInterface $entity */
    $row['id'] = $entity->toLink();
    $row['postal_code'] = $entity->get('postal_code')->getString();
    $row['house_number'] = $entity->get('house_number')->getString();
    $row['delivered'] = $entity->get('delivered')->value ? $this->t('Delivered') : $this->t('Not delivered');
    $row['order_id']['data'] = $entity->get('order_id')->view(['label' => 'hidden']);
    return $row + parent::buildRow($entity);
  }
}
