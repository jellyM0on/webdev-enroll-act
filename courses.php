<?php include 'db.php';
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: courses.php");
    exit;
}

include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_name = htmlspecialchars(trim($_POST['course_name']));

    if (!empty($course_name)) {
        $stmt = $pdo->prepare("INSERT INTO courses (course_name) VALUES (?)");
        $stmt->execute([$course_name]);
    }
}
?>

<h2 class="mb-4">Courses List</h2>

<form method="post" class="mb-3">
    <div class="input-group">
        <input type="text" name="course_name" class="form-control" placeholder="New course name" required>
        <button class="btn btn-success">Add Course</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr><th>Course Name</th><th>Actions</th></tr>
    </thead>
    <tbody>
        <?php
        $stmt = $pdo->query("SELECT * FROM courses ORDER BY course_name");
        while ($course = $stmt->fetch()):
        ?>
        <tr>
            <td><?= htmlspecialchars($course['course_name']) ?></td>
            <td>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-course-id="<?= $course['id'] ?>">Delete</button>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this course?
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
        const courseId = button.getAttribute('data-course-id');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.href = `?delete=${courseId}`;
    });
</script>

<?php include 'includes/footer.php'; ?>