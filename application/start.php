<?php

use Aws\S3\S3Client;
require 'vendor/autoload.php';
$config=require('config/s3_config.php');

$s3Client = new S3Client([
    'region' => 'eu-west-1',
    'version' => 'latest',
    'credentials' => [
        'key'    => $config['s3']['key'],
        'secret' =>$config['s3']['secret'],
    ],
]);