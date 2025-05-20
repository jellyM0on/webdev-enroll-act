<?php
include 'db.php';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: students.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<h2 class="mb-4">Students List</h2>

<a href="add_student.php" class="btn btn-success mb-3">Add Student</a>

<div class="table-responsive mb-4">
    <?php
    try {
        $stmt = $pdo->query("SELECT students.id, name, email, course_name 
                             FROM students
                             LEFT JOIN courses ON students.course_id = courses.id
                             ORDER BY course_name");

        if ($stmt) {
            $students = $stmt->fetchAll();
            if ($students && count($students) > 0):
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['course_name'] ?? '') ?></td>
                <td>
                    <a href="add_student.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-student-id="<?= $row['id'] ?>">Delete</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <i>No data to show...</i>
    <?php endif; ?>
    <?php
        } else {
            echo '<i>No data to show...</i>';
        }
    } catch (PDOException $e) {
        echo '<i>No data to show...</i>';
    }
    ?>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this student?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

<script>
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const studentId = button.getAttribute('data-student-id');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.href = `?delete=${studentId}`;
    });
</script>

<?php include 'includes/footer.php'; ?>