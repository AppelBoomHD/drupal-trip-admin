<?php

declare(strict_types=1);

namespace Drupal\trip_admin\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Provides a TripCompleted constraint.
 *
 * @Constraint(
 *   id = "TripAdministrationTripCompleted",
 *   label = @Translation("TripCompleted", context = "Validation"),
 * )
 *
 * @see https://www.drupal.org/node/2015723.
 */
final class TripAdministrationTripCompletedConstraint extends Constraint
{
  public string $message = 'You cannot add stops to a trip that has already been completed.';
}
