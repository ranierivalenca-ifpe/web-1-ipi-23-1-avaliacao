<?php
require 'conf/init.php';

$category_id = $_GET['category_id'] ?? '%';

$sql = "SELECT lost_items.*, categories.name as category FROM lost_items JOIN categories ON lost_items.category_id = categories.id WHERE lost_items.category_id LIKE :cat_id";
$statement = $pdo->prepare($sql);
$statement->execute(['cat_id' => $category_id]);
$items = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($items);