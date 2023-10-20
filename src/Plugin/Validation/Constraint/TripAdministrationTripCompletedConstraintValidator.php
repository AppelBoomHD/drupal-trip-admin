<?php

declare(strict_types=1);

namespace Drupal\trip_admin\Plugin\Validation\Constraint;

use Drupal\trip_admin\TripInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the TripCompleted constraint.
 */
final class TripAdministrationTripCompletedConstraintValidator extends ConstraintValidator
{

  /**
   * {@inheritdoc}
   */
  public function validate(mixed $value, Constraint $constraint): void
  {
    if (!$value instanceof TripInterface) {
      throw new \InvalidArgumentException(
        sprintf('The validated value must be instance of \Drupal\trip_admin\TripInterface, %s was given.', get_debug_type($value))
      );
    }

    if (is_null($value->id())) return;

    /** @var \Drupal\trip_admin\TripInterface $entity */
    $entity = \Drupal::entityTypeManager()->getStorage($value->getEntityTypeId())->load($value->id());

    // check if all currently linked stops are delivered
    foreach ($entity->get('stops') as $stop) {
      if (!empty($stop->entity) && $stop->entity->get('delivered')->value == 0) {
        return;
      }
    }

    // check if new stop is added to the trip
    if ($value->get('stops')->count() >= $entity->get('stops')->count()) {
      $this->context->buildViolation($constraint->message)
        ->atPath('stops')
        ->addViolation();
    }
  }
}
