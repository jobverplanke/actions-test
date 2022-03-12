<?php

declare(strict_types=1);

namespace Verplanke\Ikea;

use InvalidArgumentException;
use JsonException;
use Verplanke\Ikea\Contracts\Command as CommandContract;
use Verplanke\Ikea\Enums\Coap;
use Verplanke\Ikea\Exceptions\JsonEncodingException;

abstract class Builder
{
    protected array $payload;
    protected string $resource;

    protected GatewayConfig $gateway;

    public function __construct()
    {
        $this->gatewayConfig();
    }

    abstract protected function type(): string;
    abstract protected function resource(): string;
    abstract protected function payload(): array;

    public function getCommand(): string
    {
        return $this->build();
    }

    public function setPayload(array $payload): void
    {
        $this->payload = $payload + $this->payload();
    }

    public function setResource(string $resource): void
    {
        $resource = ltrim(string: $resource, characters: DIRECTORY_SEPARATOR);

        $this->resource = ($resource === $this->resource())
            ? $this->resource()
            : $this->resource() . DIRECTORY_SEPARATOR . $resource;
    }

    public function gatewayConfig(string $address = null, string $user = null, string $preSharedKey = null): void
    {
        $this->gateway = GatewayConfig::initialize(
            address: $address ?? (string) config(key: 'services.ikea.address'),
            user: $user ?? (string) config(key: 'services.ikea.user'),
            preSharedKey: $preSharedKey ?? (string) config(key: 'services.ikea.pre_shared_key')
        );
    }

    protected function build(): string
    {
        $type = match ($this->type()) {
            Coap::GET->value => Coap::CLIENT_GET->value,
            Coap::POST->value => Coap::CLIENT_POST->value,
            Coap::PUT->value => Coap::CLIENT_PUT->value,
            default => throw new InvalidArgumentException()
        };

        $arguments = sprintf(
            $type,
            $this->gateway->user,
            $this->gateway->preSharedKey,
            $this->data()
        );

        $url = sprintf(
            Coap::CLIENT_URL->value,
            $this->gateway->address,
            $this->url(),
        );

        return $arguments . $url;
    }

    private function data(): string
    {
        if (! isset($this->payload)) {
            $this->setPayload(payload: $this->payload());
        }

        try {
            return json_encode(
                value: $this->payload,
                flags: JSON_FORCE_OBJECT|JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            throw JsonEncodingException::make(message: 'Failed encoding payload.');
        }
    }

    private function url(): string
    {
        if (! isset($this->resource)) {
            $this->setResource(resource: $this->resource());
        }

        return $this->resource;
    }

    public function command(): CommandContract
    {
        return new Command(command: $this->getCommand());
    }
}

