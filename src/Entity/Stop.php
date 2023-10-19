<?php

declare(strict_types=1);

namespace Drupal\trip_admin\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\trip_admin\StopInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the stop entity class.
 *
 * @ContentEntityType(
 *   id = "trip_admin_stop",
 *   label = @Translation("Stop"),
 *   label_collection = @Translation("Stops"),
 *   label_singular = @Translation("stop"),
 *   label_plural = @Translation("stops"),
 *   label_count = @PluralTranslation(
 *     singular = "@count stops",
 *     plural = "@count stops",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\trip_admin\StopListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\trip_admin\StopAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\trip_admin\Form\StopForm",
 *       "edit" = "Drupal\trip_admin\Form\StopForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "trip_admin_stop",
 *   admin_permission = "administer trip_admin_stop",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/stop",
 *     "add-form" = "/stop/add",
 *     "canonical" = "/stop/{trip_admin_stop}",
 *     "edit-form" = "/stop/{trip_admin_stop}/edit",
 *     "delete-form" = "/stop/{trip_admin_stop}/delete",
 *     "delete-multiple-form" = "/admin/content/stop/delete-multiple",
 *   },
 * )
 */
final class Stop extends ContentEntityBase implements StopInterface
{

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array
  {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Stop'))
      ->setDescription(t('The stop ID.'))
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'inline',
        'weight' => 0,
      ])
      ->setReadOnly(TRUE)
      ->setSetting('unsigned', TRUE);

    $fields['postal_code'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Postal code'))
      ->setDescription(t('The postal code of the stop.'))
      ->setDisplayOptions('form', [
        'type' => 'text',
        'weight' => 10,
      ])
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setRequired(TRUE);

    $fields['house_number'] = BaseFieldDefinition::create('string')
      ->setLabel(t('House number'))
      ->setDescription(t('The house number of the stop.'))
      ->setDisplayOptions('form', [
        'type' => 'text',
        'weight' => 10,
      ])
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setRequired(TRUE);

    $fields['delivered'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDefaultValue(FALSE)
      ->setSettings(['on_label' => 'Delivered', 'off_label' => 'Not delivered'])
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the stop was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ]);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the stop was last edited.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ]);

    return $fields;
  }
}
