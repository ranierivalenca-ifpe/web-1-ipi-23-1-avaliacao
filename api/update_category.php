<?php
require 'conf/init.php';

$id = $_POST['id'];
$name = $_POST['name'];

try {
    $sql = 'UPDATE categories SET name = :name WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->execute();
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'name' => $name]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false]);
}