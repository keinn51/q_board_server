<?php

$name = array(["google" => "http//google.com", "yahoo"=> "http//yahoo"]);
$age = array(["google" => "http//google.com", "yahoo"=> "http//yahoo"]);

$mixed = array_merge((array) $name, (array) $age);

echo json_encode($mixed);