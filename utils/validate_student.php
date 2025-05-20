<?php
function validate_student_input($name, $email, $course_id) {
    $errors = [];

    if (empty($name) || strlen(trim($name)) > 100) {
        $errors[] = "Name is required and must be under 100 characters.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }

    if ($course_id !== null && !filter_var($course_id, FILTER_VALIDATE_INT)) {
        $errors[] = "Invalid course selection.";
    }

    return $errors;
}