<?php

declare(strict_types=1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a stop entity type.
 */
interface StopInterface extends ContentEntityInterface, EntityChangedInterface
{
}
