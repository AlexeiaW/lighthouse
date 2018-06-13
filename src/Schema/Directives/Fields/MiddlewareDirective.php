<?php

namespace Nuwave\Lighthouse\Schema\Directives\Fields;

use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Traits\HandlesDirectives;

class MiddlewareDirective extends AbstractFieldDirective implements FieldMiddleware
{
    use HandlesDirectives;

    /**
     * Name of the directive.
     *
     * @return string
     */
    public static function name()
    {
        return 'middleware';
    }

    /**
     * Resolve the field directive.
     *
     * @param FieldValue $value
     *
     * @return FieldValue
     */
    public function handleField(FieldValue $value)
    {
        $checks = $this->getChecks($value);

        if ($checks) {
            if ('Query' === $value->getParentTypeName()) {
                graphql()->middleware()->registerQuery(
                    $value->getFieldName(),
                    $checks
                );
            } elseif ('Mutation' === $value->getParentTypeName()) {
                graphql()->middleware()->registerMutation(
                    $value->getFieldName(),
                    $checks
                );
            }
        }

        return $value;
    }

    /**
     * Get middleware checks.
     *
     * @param FieldValue $value
     *
     * @return array|null
     */
    protected function getChecks(FieldValue $value)
    {
        if (! in_array($value->getParentTypeName(), ['Mutation', 'Query'])) {
            return null;
        }

        $checks = $this->associatedArgValue('checks');

        if (! $checks) {
            return null;
        }

        if (is_string($checks)) {
            $checks = [$checks];
        }

        return $checks;
    }
}
