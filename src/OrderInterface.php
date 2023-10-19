<?php declare(strict_types = 1);

namespace Drupal\trip_admin;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining an order entity type.
 */
interface OrderInterface extends ContentEntityInterface, EntityChangedInterface {

}
