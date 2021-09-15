<?php

require_once 'local_utils.php';

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
    $user_error = 'Access denied - not an AJAX request...';
    trigger_error($user_error, E_USER_ERROR);
}

$term = trim($_GET['term']);

$a_json = array();
$a_json_row = array();

$a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
$json_invalid = json_encode($a_json_invalid);

// replace multiple spaces with one
$term = preg_replace('/\s+/', ' ', $term);

if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
    print $json_invalid;
    exit;
}

include("database.php");

$parts = explode(' ', $term);
$p = count($parts);

/**
 * Create SQL
 */
$a_part_to_search = array();
$a_parts = array();
$part_type = "";
for($i = 0; $i < $p; $i++) {
    $part_type .= 's';
}
$a_parts[] = & $part_type;

foreach($parts as $part) {
    array_push($a_part_to_search, '%' . $part . '%');
}
for($i = 0; $i < $p; $i++) {
    $a_parts[] = & $a_part_to_search[$i];
}
$key=$_REQUEST['key'];
switch($key)
{
case 1:
{
$sql = 'SELECT custID FROM tbl_customer WHERE status="A"';
for($i = 0; $i < $p; $i++) {
    $sql .= ' and custID LIKE ?';
}

/* Prepare statement */
$stmt = $dbConn->prepare($sql);
if($stmt === false) {
    $user_error = 'Wrong SQL: ' . $sql . '<br>' . 'Error: ' . $dbConn->errno . ' ' . $dbConn->error;
    trigger_error($user_error, E_USER_ERROR);
}

/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
//$stmt->bind_param('s', $param); does not accept params array
call_user_func_array(array($stmt, 'bind_param'), $a_parts);

/* Execute statement */
$stmt->execute();

$stmt->bind_result($url, $post_title);

while($stmt->fetch()) {
    $a_json_row["id"] = $url;
    $a_json_row["value"] = $post_title;
    $a_json_row["label"] = $post_title;
    array_push($a_json, $a_json_row);
}

// highlight search results
$a_json = apply_highlight($a_json, $parts);

$json = json_encode($a_json);
print $json;
break;
}
}
?>