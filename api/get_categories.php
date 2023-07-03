<?php
require 'conf/init.php';

$sql = "SELECT * FROM categories ORDER BY name ASC";
$statement = $pdo->query($sql);
$items = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($items);