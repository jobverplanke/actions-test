<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Enums;

enum Coap: string
{
    case CLIENT_URL = ' "coaps://%s:5684/%s"';

    case CLIENT_GET = 'coap-client -m get -u "%s" -k "%s"';
    case CLIENT_POST = 'coap-client -m post -u "%s" -k "%s" -e \'%s\'';
    case CLIENT_PUT = 'coap-client -m put -u "%s" -k "%s" -e \'%s\'';

    case GET = 'get';
    case POST = 'post';
    case PUT = 'put';
}
