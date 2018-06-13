<?php

namespace Nuwave\Lighthouse\Schema\Directives\Types;

use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Schema\Directives\Directive;
use Nuwave\Lighthouse\Schema\Values\TypeValue;

interface TypeResolver extends Directive
{
    /**
     * Resolve the TypeValue to a GraphQL Type.
     *
     * @param TypeValue $value
     *
     * @return Type
     */
    public function resolveType(TypeValue $value);
}
