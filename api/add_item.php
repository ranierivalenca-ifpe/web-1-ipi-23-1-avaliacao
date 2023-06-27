<?php
require 'conf/init.php';

$name = $_POST['name'];
$description = $_POST['description'];
$date = $_POST['date'];
$status = $_POST['status'];
$category_id = $_POST['category_id'];

try {
    $sql = 'INSERT INTO lost_items (name, description, date, status, category_id) VALUES (:name, :description, :date, :status, :category_id)';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->bindValue(':date', $date, PDO::PARAM_STR);
    $statement->bindValue(':status', $status, PDO::PARAM_STR);
    $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    $statement->execute();
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'item' => [
        'name' => $name,
        'description' => $description,
        'date' => $date,
        'status' => $status,
        'category_id' => $category_id,
        'id' => $pdo->lastInsertId()
    ]]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false]);
}