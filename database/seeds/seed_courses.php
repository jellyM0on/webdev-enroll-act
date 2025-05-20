<?php

require_once __DIR__ . '/../../db.php';

try {
    $courses = [
        'Computer Science',
        'Information Technology',
        'Computer Engineering',
        'Chemistry',
        'Physics'
    ];

    foreach ($courses as $course_name) {
        $stmt = $pdo->prepare("INSERT INTO courses (course_name) VALUES (:course_name)");
        $stmt->execute(['course_name' => $course_name]);
    }
    echo "Courses seeded successfully.\n";

} catch (PDOException $e) {
    echo "Error seeding data: " . $e->getMessage() . "\n";
    exit(1);
}
