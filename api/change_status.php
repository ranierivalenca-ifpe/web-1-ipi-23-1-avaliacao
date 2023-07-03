<?php
require 'conf/init.php';

$id = $_POST['id'];
$status = $_POST['status'];

$sql = 'UPDATE lost_items SET status = :status WHERE id = :id';
try {
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':status', $status, PDO::PARAM_STR);
    $statement->execute();
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'status' => $status]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false]);
}