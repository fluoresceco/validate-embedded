<?php

namespace Fluoresce\ValidateEmbedded\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Validate extends Constraint
{
    /**
     * @var array Embedded groups
     */
    public $embeddedGroups = array(Constraint::DEFAULT_GROUP);
}
