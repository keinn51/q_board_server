<?php

require_once("../inc/header.php");

$data = json_decode(file_get_contents('php://input'), true);

$login_id = $data['login_id'] ?? null;
$login_pw = $data['login_pw'] ?? null;

if ($login_id == null || $login_pw == null){
    echo 'Message: not entered id or password';
//    http_response_code(401);
    exit();
}

$member_count = db_select("select * from main.user where login_id = ?" , array($login_id));

if ($member_count){
    echo 'Message: already existed ID';
    http_response_code(401);
    exit();
}

$bcrypt_pw = password_hash($login_pw, PASSWORD_BCRYPT);

$insert_result = db_insert("insert into main.user (login_id, login_pw) values (?, ?)",
    array($login_id, $bcrypt_pw)
);

if ($insert_result) {
    http_response_code(200);
}