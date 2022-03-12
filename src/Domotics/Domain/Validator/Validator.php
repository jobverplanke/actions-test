<?php

declare(strict_types=1);

namespace Verplanke\Domotics\Domain\Validator;

use Illuminate\Support\Str;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\ValidationException;
use Verplanke\Ikea\Enums\Codes;

class Validator
{
    private ValidatorFactory $validator;

    protected array $data = [];
    protected array $rules = [];
    protected array $messages = [];
    protected array $attributes = [];
    protected array $validated = [];

    public function __construct()
    {
        $translator = new Translator(loader: new ArrayLoader(), locale: 'en_US');
        $this->validator = new ValidatorFactory(translator: $translator);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(array $data, array $rules, array $messages, array $attributes = []): void
    {
        $validation = $this->validator->make(
            data: $this->mapToAttributes(data: $data),
            rules: $this->mapToAttributes(data: $rules),
            messages: $this->mapMessagesToAttributes(data: $messages),
            customAttributes: $this->mapToAttributes(data: $attributes),
        );

        if ($validation->fails()) {
            throw new ValidationException(validator: $validation);
        }

        $this->validated = $validation->validated();
    }

    public function validated(): array
    {
        return $this->validated;
    }

    private function mapToAttributes(array $data): array
    {
        return collect(value: $data)
            ->flatMap(callback: function ($item, $key) {
                $attribute = Str::lower(value: Codes::from(value: (string) $key)->name);

                return [$attribute => $item];
            })->all();
    }

    private function mapMessagesToAttributes(array $data): array
    {
        return collect(value: $data)
            ->flatMap(callback: function ($item, $key) {
                $code = Str::before(subject: $key, search: '.');
                $index = Str::of(string: $key)
                    ->replace(search: $code, replace: Codes::from(value: $code)->name)
                    ->lower();

                return [(string) $index => $item];
            })->all();
    }
}
