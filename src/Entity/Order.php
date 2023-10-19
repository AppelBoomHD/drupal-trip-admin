<?php

declare(strict_types=1);

namespace Drupal\trip_admin\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\trip_admin\OrderInterface;

/**
 * Defines the order entity class.
 *
 * @ContentEntityType(
 *   id = "trip_admin_order",
 *   label = @Translation("Order"),
 *   label_collection = @Translation("Orders"),
 *   label_singular = @Translation("order"),
 *   label_plural = @Translation("orders"),
 *   label_count = @PluralTranslation(
 *     singular = "@count orders",
 *     plural = "@count orders",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\trip_admin\OrderListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\trip_admin\OrderAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\trip_admin\Form\OrderForm",
 *       "edit" = "Drupal\trip_admin\Form\OrderForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "trip_admin_order",
 *   admin_permission = "administer trip_admin_order",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/order",
 *     "add-form" = "/order/add",
 *     "canonical" = "/order/{trip_admin_order}",
 *     "edit-form" = "/order/{trip_admin_order}/edit",
 *     "delete-form" = "/order/{trip_admin_order}/delete",
 *     "delete-multiple-form" = "/admin/content/order/delete-multiple",
 *   },
 * )
 */
final class Order extends ContentEntityBase implements OrderInterface
{

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array
  {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Order'))
      ->setDescription(t('The order number.'))
      ->setDisplayOptions('form', [
        'type' => 'text',
        'weight' => 10,
      ])
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'inline',
        'weight' => 0,
      ])
      ->setRequired(TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 10,
      ])
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setRequired(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created at'))
      ->setDescription(t('The time that the trip was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ]);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed at'))
      ->setDescription(t('The time that the trip was last edited.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ]);

    return $fields;
  }
}
