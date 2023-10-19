<?php

declare(strict_types=1);

namespace Drupal\trip_admin\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\trip_admin\TripInterface;

/**
 * Defines the trip entity class.
 *
 * @ContentEntityType(
 *   id = "trip_admin_trip",
 *   label = @Translation("Trip"),
 *   label_collection = @Translation("Trips"),
 *   label_singular = @Translation("trip"),
 *   label_plural = @Translation("trips"),
 *   label_count = @PluralTranslation(
 *     singular = "@count trips",
 *     plural = "@count trips",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\trip_admin\TripListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\trip_admin\TripAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\trip_admin\Form\TripForm",
 *       "edit" = "Drupal\trip_admin\Form\TripForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "trip_admin_trip",
 *   admin_permission = "administer trip_admin_trip",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/trip",
 *     "add-form" = "/trip/add",
 *     "canonical" = "/trip/{trip_admin_trip}",
 *     "edit-form" = "/trip/{trip_admin_trip}/edit",
 *     "delete-form" = "/trip/{trip_admin_trip}/delete",
 *     "delete-multiple-form" = "/admin/content/trip/delete-multiple",
 *   },
 * )
 */
final class Trip extends ContentEntityBase implements TripInterface
{

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array
  {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Trip'))
      ->setDescription(t('The trip ID.'))
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'inline',
        'weight' => 0,
      ])
      ->setReadOnly(TRUE)
      ->setSetting('unsigned', TRUE);

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

    $fields['start'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('Start time'))
      ->setDescription(t('The date and time that the trip should start.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
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
