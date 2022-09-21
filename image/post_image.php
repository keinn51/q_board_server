<?php

require_once("../inc/header.php");
include_once('../vendor/autoload.php');

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\CredentialProvider;

// S3 client Info
$s3Client = new Aws\S3\S3Client(array(
    'region' => 'ap-northeast-2',
    'version' => 'latest',
    'signature' => 'v4',
    'credentials' => [
        'key'    => getenv('S3_ACCESS_KEY'),
        'secret' => getenv('S3_SECRET_KEY'),
    ],
));

$s3_path = 'lks_img/' . $_POST['boardId'];
$file_path = $_FILES['file']['tmp_name'];
$result = $s3Client->putObject(array(
    'Bucket' => getenv('S3_BUCKET'),
    'Key'    => $s3_path,
    'SourceFile' => $file_path,
    'ContentType' => $_FILES['file']['type']
));

echo json_encode($_FILES);