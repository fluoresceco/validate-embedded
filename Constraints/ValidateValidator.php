<?php

namespace Fluoresce\ValidateEmbedded\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Validates objects embedded within properties on a parent object.
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class ValidateValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Validate) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Validate');
        }

        if (null === $value) {
            return;
        }

        if (!is_object($value) && !is_array($value)) {
            throw new UnexpectedTypeException($value, 'object');
        }

        // Validate the embedded object(s)
        $this->context->getValidator()
            ->inContext($this->context)
            ->validate($value, null, $constraint->embeddedGroups);
    }
}
