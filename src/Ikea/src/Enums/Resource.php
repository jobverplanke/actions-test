<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Enums;

enum Resource: string
{
    case OFF = '0';
    case ON = '1';

    case ROOT_ENDPOINTS = '.well-known/core';

    case ROOT_DEVICES = '15001';
    case ROOT_GROUPS = '15004';
    case ROOT_SCENES = '15005';
    case ROOT_NOTIFICATION = '15006';
    case ROOT_SMART_TASKS = '15010';
    case ROOT_GATEWAY = '15011';

    case ATTR_LIGHT_COLOR_HEX = '5706';
    case ATTR_TRANSITION_TIME = '5712';
    case ATTR_LIGHT_STATE = '5850';
    case ATTR_LIGHT_DIMMER = '5851';
    case ATTR_NAME = '9001';
    case ATTR_ID = '9003';

    case ATTR_CLIENT_IDENTITY = '9090';
}
