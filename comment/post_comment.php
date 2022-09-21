<?php

require_once("../inc/header.php");

$data = json_decode(file_get_contents('php://input'), true);

$post_content = $data['content'] ?? null;
$post_boardId = $data['boardId'] ?? null;
$post_loginId = $data['loginId'] ?? null;
$post_userId = $data['userId'] ?? null;

if ($post_content === null || $post_boardId === null
    || $post_loginId === null || $post_userId === null) {
    echo 'Message: parameter lacks';
    exit();
}

$insert_result = db_insert("insert into main.comment (boardId, loginId, userId, content) values (?, ?, ?, ?)",
    array($post_boardId, $post_loginId, $post_userId, $post_content)
);

if ($insert_result) {
    echo $insert_result;
    http_response_code(200);
}