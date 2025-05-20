<?php
include 'db.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_course_id'])) {
    $edit_id = (int)$_POST['edit_course_id'];
    $new_name = htmlspecialchars(trim($_POST['edit_course_name']));
    
    if (!empty($new_name)) {
        $stmt = $pdo->prepare("UPDATE courses SET course_name = ? WHERE id = ?");
        $stmt->execute([$new_name, $edit_id]);
        header("Location: courses.php");
        exit;
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

<div class="table-responsive mb-4">
<?php
try {
    $stmt = $pdo->query("SELECT * FROM courses ORDER BY course_name");
    if ($stmt) {
        $courses = $stmt->fetchAll();
        if ($courses && count($courses) > 0):
?>
    <table class="table table-bordered">
        <thead>
            <tr><th>Course Name</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
            <tr>
                <td><?= htmlspecialchars($course['course_name']) ?></td>
                <td>
                    <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editCourseModal"
                            data-course-id="<?= $course['id'] ?>"
                            data-course-name="<?= htmlspecialchars($course['course_name']) ?>">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal"
                            data-course-id="<?= $course['id'] ?>">
                        Delete
                    </button>
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
        Are you sure you want to delete this course?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="edit_course_id" id="editCourseId">
        <div class="mb-3">
          <label for="editCourseName" class="form-label">Course Name</label>
          <input type="text" name="edit_course_name" class="form-control" id="editCourseName" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
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

    const editCourseModal = document.getElementById('editCourseModal');
    editCourseModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const courseId = button.getAttribute('data-course-id');
        const courseName = button.getAttribute('data-course-name');
        document.getElementById('editCourseId').value = courseId;
        document.getElementById('editCourseName').value = courseName;
    });
</script>

<?php include 'includes/footer.php'; ?>