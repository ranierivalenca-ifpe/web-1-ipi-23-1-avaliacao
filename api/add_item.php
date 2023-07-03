<?php
require 'conf/init.php';

$name = $_POST['name'];
$description = $_POST['description'];
$status = $_POST['status'];
$owner = $_POST['owner'];
$contact = $_POST['contact'];
$category_id = $_POST['category_id'];

try {
    $sql = "INSERT INTO lost_items (name, description, status, owner, contact, category_id) VALUES (:name, :description, :status, :owner, :contact, :category_id)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':status', $status);
    $statement->bindValue(':owner', $owner);
    $statement->bindValue(':contact', $contact);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'item' => [
        'name' => $name,
        'description' => $description,
        'owner' => $owner,
        'contact' => $contact,
        'status' => $status,
        'category_id' => $category_id,
        'id' => $pdo->lastInsertId()
    ]]);
} catch (PDOException $e) {
    echo $e->getMessage();
    header('Content-Type: application/json');
    echo json_encode(['success' => false]);
}