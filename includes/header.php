<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
   <style>
        @media (min-width: 992px) {
            #sidebarMenu {
                min-height: 100vh;
            }
        }

        .nav-link.text-dark:hover {
            background-color: #e9ecef;
            color: #000 !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="bi bi-mortarboard"></i>
            Enrollment System
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-lg-2 d-lg-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <?php
                    $current = basename($_SERVER['REQUEST_URI']);
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php echo ($current === 'enroll.php' || $current === '') ? 'fw-bold bg-body-tertiary' : ''; ?>" href="../enroll.php">
                            Enroll
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php echo ($current === 'students.php') ? 'fw-bold bg-body-tertiary' : ''; ?>" href="../students.php">
                            Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php echo ($current === 'courses.php') ? 'fw-bold bg-body-tertiary' : ''; ?>" href="../courses.php">
                            Courses
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-lg-10 ms-sm-auto px-md-4 mt-4">
            <div class="container">