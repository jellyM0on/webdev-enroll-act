<?php

require_once __DIR__ . '/../../db.php';

try {
    $students = [
        ['name' => 'Alice', 'email' => 'alice@example.com', 'course_id' => 1],
        ['name' => 'Bob', 'email' => 'bob@example.com', 'course_id' => 2],
        ['name' => 'Charlie', 'email' => 'charlie@example.com', 'course_id' => 3],
        ['name' => 'David', 'email' => 'david@example.com', 'course_id' => 4],
        ['name' => 'Eve', 'email' => 'eve@example.com', 'course_id' => 5],
        ['name' => 'Jane', 'email' => 'jane@example.com', 'course_id' => null]
    ];

    foreach ($students as $student) {
        $stmt = $pdo->prepare("
            INSERT INTO students (name, email, course_id) 
            VALUES (:name, :email, :course_id)
        ");
        $stmt->execute($student);
    }
    echo "Students seeded successfully.\n";

} catch (PDOException $e) {
    echo "Error seeding data: " . $e->getMessage() . "\n";
    exit(1);
}
