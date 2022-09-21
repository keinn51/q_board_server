<?php

require_once("../inc/header.php");

$data = json_decode(file_get_contents('php://input'), true);

$post_boardId = $data['boardId'] ?? null;
$post_userId = $data['userId'] ?? null;

if ($post_boardId === null || $post_userId == null){
    echo 'MessageL parameter lacks';
    exit();
}

$result = db_update_delete("delete from main.board where boardId = ? and userId = ?",
    array($post_boardId, $post_userId)
);

if ($result) {
    echo $result;
    http_response_code(200);
}