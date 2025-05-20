<?php

require_once __DIR__ . '/../../db.php';

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            course_name VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");
    echo "Courses table created successfully.\n";

} catch (PDOException $e) {
    echo "Error creating courses table: " . $e->getMessage() . "\n";
    exit(1);
}
