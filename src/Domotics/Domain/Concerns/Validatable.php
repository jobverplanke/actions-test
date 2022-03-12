<?php

declare(strict_types=1);

namespace Verplanke\Domotics\Domain\Concerns;

use Verplanke\Domotics\Domain\Validator\Validator;

trait Validatable
{
    protected Validator $validator;

    protected function hasValidation(): bool
    {
        return method_exists(object_or_class: $this, method: 'rules')
            && method_exists(object_or_class: $this, method: 'messages');
    }

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }
}

