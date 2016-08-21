<?php

//http://localhost/rest/BlogSqlite/rest.php/{$blog}/{$table}/{$id}
header('Access-Control-Allow-Origin: *');  
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

// retrieve the table and key from the path
if ($request[0]) {
    $blog = $request[0];
    if ( count($request)>1 ) $table =  $request[1];
    if ( count( $request)>2 ) $key = $request[2];
} else {
    echo 'false';
    exit();
}
//$table = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));
//$key = array_shift($request) + 0;
$set = '';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resttest";

// Create connection
try {
    $db = new mysqli($servername, $username, $password, $dbname);
    /* Other Codes */
} catch (PDOException $e) {
    echo "Error: " . $e;
}
switch ($method) {
    case 'GET':
        $sql = "select * from $table" . " WHERE IdBlog = $blog" . (isset($key) ? " AND idRow = $key" : '');
        
        $res = $db->query($sql);
        $res = $res->fetch_all();
        echo(json_encode($res));
        break;
    case 'PUT':
        $index = 1;
        foreach ($_GET as $keyGet => $valueGet) {
            $set .= " $keyGet = '$valueGet'";
            if (count($_GET) != $index++) {
                $set .= ',';
            }
        };

        $sql = "update `$table` set $set WHERE IdBlog = $blog and idRow=$key";
        $res = $db->query($sql);
        break;
    case 'POST':
        $set .= '(';
        $keyGets = "";
        $valueGets = "(";
        $index = 1;
        foreach ($_GET as $keyGet => $valueGet) {
            $keyGets .= " $keyGet ";
            $valueGets .= " '$valueGet'";
            if (count($_GET) != $index++) {
                $keyGets .= ',';
                $valueGets .= ',';
            } else {
                $keyGets .= ')';
                $valueGets .= ')';
            }
        };
        $set .= $keyGets . " values " . $valueGets;

        $sql = "insert into `$table`  $set";
        $res = $db->query($sql);
        break;
    case 'DELETE':
        $sql = "DELETE FROM `$table` WHERE IdBlog = $blog and idRow = $key";
        $res = $db->query($sql);
        break;
}

//var_dump($sql);
//var_dump($_GET);
//($res ? var_dump($res) : "");

