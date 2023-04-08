<?php

namespace CowSay;

require __DIR__ . '/vendor/autoload.php';

$bessie = new Cow('Hello, Farm!');
$bessie->setEyes('oO')
    ->setTongue('U')
    ->setPoop('@@@')
    ->setUdder('W');
echo $bessie;
