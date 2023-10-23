<?php

declare(strict_types=1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the trip entity type.
 */
final class TripListBuilder extends SortableListBuilder
{

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array
  {
    $header['id'] = [
      'data' => $this->t('Trip number'),
      'field' => 'id',
      'specifier' => 'id',
    ];
    $header['start'] = [
      'data' => $this->t('Start time'),
      'field' => 'start',
      'specifier' => 'start',
    ];
    $header['completed'] = [
      'data' => $this->t('Status'),
      'field' => 'completed',
      'specifier' => 'completed',
    ];
    $header['stops'] = [
      'data' => $this->t('Stops'),
      'field' => 'stops',
      'specifier' => 'stops',
    ];
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array
  {
    /** @var \Drupal\trip_admin\TripInterface $entity */
    $row['id'] = $entity->toLink();
    $row['start']['data'] = $entity->get('start')->view(['label' => 'hidden']);
    $row['completed'] = $entity->get('completed')->value ? $this->t('Completed') : $this->t('Not completed');
    $row['stops']['data'] = $entity->get('stops')->view(['label' => 'hidden']);
    return $row + parent::buildRow($entity);
  }
}
