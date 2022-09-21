<?php

require_once("../inc/header.php");

$data = json_decode(file_get_contents('php://input'), true);

$post_title = $data['title'] ?? null;
$post_content = $data['content'] ?? null;
$post_categoryId = $data['categoryId'] ?? null;
$post_userId = $data['userId'] ?? null;
$post_loginId = $data['loginId'] ?? null;

if ($post_title === null || $post_content === null
    || $post_categoryId === null || $post_userId === null || $post_loginId === null){
    echo 'Message: parameter lacks';
    exit();
}

$post_id = db_insert("insert into main.board (title, content, categoryId, userId, loginId) values (?, ?, ?, ?, ?)",
    array($post_title, $post_content, $post_categoryId, $post_userId, $post_loginId)
);

if ($post_id) {
    echo $post_id;
    http_response_code(200);
}