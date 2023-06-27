<?php
require 'conf/init.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$date = $_POST['date'];
$status = $_POST['status'];
$category_id = $_POST['category_id'];

$sql = 'UPDATE lost_items SET name = :name, description = :description, date = :date, status = :status, category_id = :category_id WHERE id = :id';
try {
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->bindValue(':date', $date, PDO::PARAM_STR);
    $statement->bindValue(':status', $status, PDO::PARAM_STR);
    $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    $statement->execute();
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false]);
}