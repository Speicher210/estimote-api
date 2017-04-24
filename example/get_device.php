<?php

declare(strict_types = 1);

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use Speicher210\Estimote\Auth\Application;
use Speicher210\Estimote\ClientAppAuth;
use Speicher210\Estimote\Resource\Device;

require_once dirname(__DIR__) . '/vendor/autoload.php';

AnnotationRegistry::registerLoader('class_exists');

$deviceIdentifier = 'YOUR-DEVICE-ID';
$appId = 'YOUR-APP-ID';
$appToken = 'YOUR-APP-TOKEN';
$appAuth = new Application($appId, $appToken);

$client = new ClientAppAuth($appAuth);
$serializer = SerializerBuilder::create()->build();

$deviceResource = new Device($client, $serializer);

$device = $deviceResource->getDevice($deviceIdentifier);

print_r($device);
