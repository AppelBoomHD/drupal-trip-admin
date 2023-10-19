<?php

declare(strict_types=1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the trip entity type.
 */
final class TripListBuilder extends EntityListBuilder
{

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array
  {
    $header['id'] = $this->t('ID');
    $header['start'] = $this->t('Start time');
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
    return $row + parent::buildRow($entity);
  }
}
