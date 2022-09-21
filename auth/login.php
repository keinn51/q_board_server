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

$member_data = db_select("select * from main.user where login_id = ?", array($login_id));
$is_match_password = password_verify($login_pw, $member_data[0]['login_pw']);

try {
    if ($member_data == null || count($member_data) == 0){
        throw new Exception("You are not a registered member");
    }
    if ($is_match_password === false){
        throw new Exception("password error");
    }
}
catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
    http_response_code(401);
    exit();
}

header('Content-type: application/json');
$data = [ 'userId' => intval($member_data[0]['userId']), 'loginId' => $member_data[0]['login_id'], 'role' =>intval($member_data[0]['role']) ];
echo json_encode( $data );