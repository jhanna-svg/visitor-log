<?php

require_once 'config.php';

function addVisitor($name, $contact, $purpose) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO guests (NAME, CONTACT, PURPOSE) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $contact, $purpose);
    return $stmt->execute();
}

function getAllVisitors() {
    global $conn; 

    $result = $conn->query("SELECT * FROM guests ORDER BY date_logged DESC;");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getVisitorById($guest_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM guests WHERE GUEST_ID = ?");
    $stmt->bind_param("i", $guest_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function updateVisitor($guest_id, $name, $contact, $purpose) {
    global $conn;

    $stmt = $conn->prepare("UPDATE guests SET NAME = ?, CONTACT = ?, PURPOSE = ? WHERE GUEST_ID = ?");
    $stmt->bind_param("sssi", $name, $contact, $purpose, $guest_id);
    return $stmt->execute();
}

function deleteVisitor($guest_id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM guests WHERE GUEST_ID = ?");
    $stmt->bind_param("i", $guest_id);
    return $stmt->execute();
}

?>
