<?php

// CORS Error preventing
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Content-type:text/html;charset=utf-8");

// error reporting
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// functions for connection with mysql
function db_get_pdo()
{
    $host = getenv('MYSQL_HOST');
    $port = getenv('MYSQL_PORT');
    $dbname = 'main';
    $charset = 'utf8';
    $username = getenv('MYSQL_USER');
    $db_pw = getenv('MYSQL_PW');
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
    return new PDO($dsn, $username, $db_pw);
}

function db_select($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $st->execute($param);
        $result = $st->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $result;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}

function db_insert($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        $last_id = $pdo->lastInsertId();
        $pdo = null;
        if ($result) {
            return $last_id;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}

function db_update_delete($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        $pdo = null;
        return $result;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}