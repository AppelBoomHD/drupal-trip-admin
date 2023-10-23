<?php

declare(strict_types=1);

namespace Drupal\trip_admin\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the stop entity edit forms.
 */
final class StopForm extends ContentEntityForm
{

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int
  {
    $result = parent::save($form, $form_state);

    $message_args = ['%label' => $this->entity->toLink()->toString()];
    $logger_args = [
      '%label' => $this->entity->label(),
      'link' => $this->entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New stop %label has been created.', $message_args));
        $this->logger('trip_admin')->notice('New stop %label has been created.', $logger_args);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The stop %label has been updated.', $message_args));
        $this->logger('trip_admin')->notice('The stop %label has been updated.', $logger_args);
        break;

      default:
        throw new \LogicException('Could not save the entity.');
    }

    $form_state->setRedirectUrl($this->entity->toUrl());

    return $result;
  }

  public function buildEntity(array $form, FormStateInterface $form_state)
  {
    $stop = parent::buildEntity($form, $form_state);
    $postal_code = strtoupper($form_state->getValue('postal_code')[0]['value']);

    if (strlen($postal_code) === 6) {
      $postal_code = substr_replace($postal_code, ' ', 4, 0);
    }

    $stop->set('postal_code', $postal_code);

    $trips = \Drupal::entityTypeManager()->getStorage('trip_admin_trip')->loadMultiple();

    foreach ($trips as $trip) {
      foreach ($trip->get('stops') as $s) {
        if (!empty($s->entity) && $s->entity->id() == $stop->id() && $s->entity->get('delivered')->value != $form_state->getValue('delivered')) {
          $trip->set('completed', $form_state->getValue('delivered'));
          $trip->save();
          continue;
        }
      }
    }

    return $stop;
  }
}
