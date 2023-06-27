<?php
require 'conf/init.php';

$name = $_POST['name'];

$sql = 'INSERT INTO categories (name) VALUES (:name)';
$statement = $pdo->prepare($sql);
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->execute();

header('Content-Type: application/json');
echo json_encode(['success' => true]);