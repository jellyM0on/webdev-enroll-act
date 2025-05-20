## Enrollment System Activity 

### Goal 
- Build a simple web-based Student Enrollment System where you can : 
  - Add, view, update, delete students
  - Add and manage courses
  - Enroll students in courses
  - Display enrolled students in each course
- Pages to implement: 
  - students.php – List all students with their course
  - add_student.php – Form to add new student
  - courses.php – Manage courses
  - enroll.php – Enroll a student in a course

### Demo

### Set up
- Run the server using php -S localhost:8000/[PORT] or XAMPP
- Fill in the correct db configs in db.php 
- To create and migrate the tables, run: 
  - php database/migrations/create_courses_table.php
  - php database/migrations/create_students_table.php
- To seed sample data, run:
  - php database/seeds/seed_courses.php
  - php database/seeds/seed_students.php