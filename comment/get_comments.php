<?php

require_once("../inc/header.php");

$boardId = $_GET['boardId'] ?? null;

if ($boardId == null){
    echo 'Message: not entered id or password';
    exit();
}

$comments_data = db_select("select * from main.comment where boardId = ?", array($boardId));

function translate_type($info_object) {
    $info_object['boardId'] = intval($info_object['boardId']);
    $info_object['userId'] = intval($info_object['userId']);
    $info_object['commentId'] = intval($info_object['commentId']);
    return $info_object;
}

header('Content-type: application/json');
echo json_encode( array_map('translate_type', $comments_data ));