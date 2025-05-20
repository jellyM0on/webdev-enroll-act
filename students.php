<?php include 'includes/header.php'; include 'db.php'; ?>

<h2 class="mb-4">Students List</h2>

<a href="add_student.php" class="btn btn-success mb-3">Add Student</a>

<div class="table-responsive mb-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT students.id, name, email, course_name 
                                 FROM students
                                 LEFT JOIN courses ON students.course_id = courses.id
                                 ORDER BY course_name");

            while ($row = $stmt->fetch()):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['course_name'] ?? '') ?></td>
                <td>
                    <a href="add_student.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this student?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: students.php");
    exit;
}
?>

<?php include 'includes/footer.php'; ?>
