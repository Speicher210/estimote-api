<?php

declare(strict_types = 1);

use Doctrine\Common\Annotations\AnnotationRegistry;
use Speicher210\Estimote\Auth\Application;
use Speicher210\Estimote\ClientAppAuth;
use Speicher210\Estimote\Model\Device\PendingSettings;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers\IBeacon;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers\EddystoneUrl;
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
$currentEddystoneUrl = $currentBeacon->settings()->advertisers()->eddystoneUrl();
$iBeacon = new IBeacon(
    1,
    true,
    $currentIBeacon->uuid(),
    $currentIBeacon->major(),
    12345,
    $currentIBeacon->power(),
    $currentIBeacon->interval(),
    $currentIBeacon->nonStrictModeEnabled()
);

$eddystoneUrl = new EddystoneUrl(
    1,
    true,
    $currentEddystoneUrl->power(),
    $currentEddystoneUrl->interval(),
    'https://www.example.com/123456798123456798'
);

$advertisers = new Advertisers($iBeacon, $eddystoneUrl);
$pendingSettings = new PendingSettings($advertisers);
$newData = new Update($pendingSettings);
$response = $deviceResource->updateDevice($deviceIdentifier, $newData);
var_dump($response);

$updatedDevice = $deviceResource->getDevice($deviceIdentifier);
print_r($updatedDevice);
