<?php
require 'conf/init.php';

$sql = "SELECT * FROM categories";
$statement = $pdo->query($sql);
$items = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($items);