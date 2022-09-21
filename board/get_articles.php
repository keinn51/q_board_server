<?php

require_once("../inc/header.php");

$categoryId = $_GET['categoryId'];

$board_data = db_select("select * from main.board where categoryId = ?" , array($categoryId));

header('Content-type: application/json');

function translate_type($info_object) {
    $info_object['boardId'] = intval($info_object['boardId']);
    $info_object['categoryId'] = intval($info_object['categoryId']);
    $info_object['userId'] = intval($info_object['userId']);
    return $info_object;
}

echo json_encode( array_map('translate_type', $board_data ));