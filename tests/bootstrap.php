<?php

declare(strict_types = 1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
