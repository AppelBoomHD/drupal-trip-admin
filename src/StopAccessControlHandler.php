<?php declare(strict_types = 1);

namespace Drupal\trip_admin;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the stop entity type.
 *
 * phpcs:disable Drupal.Arrays.Array.LongLineDeclaration
 *
 * @see https://www.drupal.org/project/coder/issues/3185082
 */
final class StopAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account): AccessResult {
    return match($operation) {
      'view' => AccessResult::allowedIfHasPermissions($account, ['view trip_admin_stop', 'administer trip_admin_stop'], 'OR'),
      'update' => AccessResult::allowedIfHasPermissions($account, ['edit trip_admin_stop', 'administer trip_admin_stop'], 'OR'),
      'delete' => AccessResult::allowedIfHasPermissions($account, ['delete trip_admin_stop', 'administer trip_admin_stop'], 'OR'),
      default => AccessResult::neutral(),
    };
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL): AccessResult {
    return AccessResult::allowedIfHasPermissions($account, ['create trip_admin_stop', 'administer trip_admin_stop'], 'OR');
  }

}
