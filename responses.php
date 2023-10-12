<?php
session_start();
include('db/db.php');
$sql = "SELECT keyword, response FROM chat_responses";
$result = $con->query($sql);

$responses = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $responses[$row["keyword"]] = $row["response"];
  }
}
$con->close();

echo json_encode($responses);
?>