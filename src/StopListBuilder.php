<?php

declare(strict_types=1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the stop entity type.
 */
final class StopListBuilder extends SortableListBuilder
{

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array
  {
    $header['id'] = [
      'data' => $this->t('Stop number'),
      'field' => 'id',
      'specifier' => 'id',
    ];
    $header['postal_code'] = [
      'data' => $this->t('Postal code'),
      'field' => 'postal_code',
      'specifier' => 'postal_code',
    ];
    $header['house_number'] = [
      'data' => $this->t('House number'),
      'field' => 'house_number',
      'specifier' => 'house_number',
    ];
    $header['delivered'] = [
      'data' => $this->t('Status'),
      'field' => 'delivered',
      'specifier' => 'delivered',
    ];
    $header['order_id'] = [
      'data' => $this->t('Order'),
      'field' => 'order_id',
      'specifier' => 'order_id',
    ];
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
