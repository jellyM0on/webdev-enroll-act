<?php include 'includes/header.php'; include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$name = $email = '';
$course_id = null;
$error = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch();

    if ($student) {
        $name = $student['name'];
        $email = $student['email'];
        $course_id = $student['course_id'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $course_id = isset($_POST['course_id']) && $_POST['course_id'] !== ''
        ? (int)$_POST['course_id']
        : null;

    try {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE students SET name = ?, email = ?, course_id = ? WHERE id = ?");
            $stmt->execute([$name, $email, $course_id, $id]);
            header("Location: students.php");
            exit;
        } else {
            $stmt = $pdo->prepare("INSERT INTO students (name, email, course_id) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $course_id]);
            header("Location: students.php");
            exit;
        }
    } catch (PDOException $e) {
        // Code below refers to error for duplicate entries in the email field
        if ($e->getCode() == 23000) {
            $error = "A student with this email already exists.";
        } else {
            $error = "Failed to save the student: " . $e->getMessage();
        }
    }
}
?>

<a href="./students.php" class="btn btn-secondary mb-3">← Back to Students</a>

<h2 class="mt-4 mb-4">Student Form</h2>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"> <?= htmlspecialchars($error) ?> </div>
<?php endif; ?>

<form method="post" class="mb-4">
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
    </div>
    <div class="mb-3">
        <label>Course</label>
        <select name="course_id" class="form-control">
            <option value="">Select Course</option>
            <?php
            $stmt = $pdo->query("SELECT id, course_name FROM courses ORDER BY course_name ASC");
            while ($course = $stmt->fetch()):
            ?>
                <option value="<?= $course['id'] ?>" <?= $course_id == $course['id'] ? 'selected' : '' ?>
                ><?= htmlspecialchars($course['course_name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <button class="btn btn-primary">Save</button>
</form>

<?php include 'includes/footer.php'; ?>