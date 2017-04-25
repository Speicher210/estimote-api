<?php

declare(strict_types = 1);

use Doctrine\Common\Annotations\AnnotationRegistry;
use Speicher210\Estimote\Auth\Application;
use Speicher210\Estimote\ClientAppAuth;
use Speicher210\Estimote\Model\Device\PendingSettings;
use Speicher210\Estimote\Model\Device\Settings\Advertisers;
use Speicher210\Estimote\Model\Device\Settings\Advertisers\IBeacon;
use Speicher210\Estimote\Model\Device\Update;
use Speicher210\Estimote\Resource\Device;

require_once dirname(__DIR__) . '/vendor/autoload.php';

AnnotationRegistry::registerLoader('class_exists');

$deviceIdentifier = 'YOUR-DEVICE-ID';
$appId = 'YOUR-APP-ID';
$appToken = 'YOUR-APP-TOKEN';
$appAuth = new Application($appId, $appToken);

$client = new ClientAppAuth($appAuth);

$deviceResource = new Device($client);

$currentBeacon = $deviceResource->getDevice($deviceIdentifier);
$currentIBeacon = $currentBeacon->settings()->advertisers()->ibeacon();
$iBeacon = new IBeacon(
    1,
    'new name',
    true,
    $currentIBeacon->uuid(),
    $currentIBeacon->major(),
    12345,
    $currentIBeacon->power(),
    $currentIBeacon->interval(),
    $currentIBeacon->nonStrictModeEnabled()
);

$advertisers = new Advertisers($iBeacon, $currentBeacon->settings()->advertisers()->eddystoneUrl());
$pendingSettings = new PendingSettings($advertisers);
$newData = new Update($pendingSettings);
$response = $deviceResource->updateDevice($deviceIdentifier, $newData);
var_dump($response);

$updatedDevice = $deviceResource->getDevice($deviceIdentifier);
print_r($updatedDevice);
