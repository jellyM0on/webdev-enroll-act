<?php include 'includes/header.php'; include 'db.php'; ?>

<h2>Enrollment</h2>
<form method="post" class="mt-4 mb-4">
    <div class="row">
        <div class="col">
            <select name="student_id" class="form-control" required>
                <option value="">Select Student</option>
                <?php
                $students = $pdo->query("SELECT id, name FROM students");
                while ($student = $students->fetch()):
                ?>
                    <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col">
            <select name="course_id" class="form-control" required>
                <option value="">Select Course</option>
                <?php
                $courses = $pdo->query("SELECT id, course_name FROM courses");
                while ($course = $courses->fetch()):
                ?>
                    <option value="<?= $course['id'] ?>"><?= htmlspecialchars($course['course_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col">
            <button class="btn btn-primary">Enroll</button>
        </div>
    </div>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = (int)$_POST['student_id'];
    $course_id = (int)$_POST['course_id'];

    if ($student_id && $course_id) {
        $stmt = $pdo->prepare("UPDATE students SET course_id = ? WHERE id = ?");
        $stmt->execute([$course_id, $student_id]);
        // When a student is enrolled, it should display a success notification that disappears after 5secs
        echo "
            <div id='enrollAlert' class='alert alert-success'>Student enrolled successfully.</div>
            <script>
                setTimeout(function() {
                    var alert = document.getElementById('enrollAlert');
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    }
                }, 5000);
            </script>
        ";
    }
}
?>

<h4>Unenrolled Students</h4>
<?php
$stmt = $pdo->query("SELECT name, email 
                     FROM students 
                     WHERE course_id IS NULL
                     ORDER BY name");
$unenrolled = $stmt->fetchAll();

if ($unenrolled):
?>
<table class="table table-bordered">
    <thead><tr><th>Student</th><th>Email</th></tr></thead>
    <tbody>
        <?php foreach ($unenrolled as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<i>No data to show...</i>
<?php endif; ?>


<h4 class="mt-4">Enrolled Students</h4>
<?php
$stmt = $pdo->query("SELECT students.name, courses.course_name FROM students
                     LEFT JOIN courses ON students.course_id = courses.id
                     WHERE students.course_id IS NOT NULL
                     ORDER BY course_name");
$enrolled = $stmt->fetchAll();

if ($enrolled):
?>
<table class="table table-bordered">
    <thead><tr><th>Student</th><th>Course</th></tr></thead>
    <tbody>
        <?php foreach ($enrolled as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['course_name'] ?? '') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No data to show...</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
