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
- Tools: PHP, mySQL, Bootstrap 
**This activity only uses default Bootstrap styling

### Documentation
- Demo 

https://github.com/user-attachments/assets/1b75363e-c49a-4995-a6fd-68c25403aed3


- Enrollment Page
<img width="400" alt="Screenshot 2025-05-20 at 22 16 20" src="https://github.com/user-attachments/assets/55af3612-3016-4db9-b95c-9995604f1638" />

- Students page
<img width="400" alt="Screenshot 2025-05-20 at 22 17 47" src="https://github.com/user-attachments/assets/3dbe69de-bc38-409c-af58-2ca9332f68b7" />

- Students page Delete modal 
<img width="400" alt="Screenshot 2025-05-20 at 22 18 06" src="https://github.com/user-attachments/assets/ff63f34f-3187-479b-9285-bba83351fc53" />

- Student form
<img width="400" alt="Screenshot 2025-05-20 at 22 17 58" src="https://github.com/user-attachments/assets/2f32bfbc-4ded-47ab-97be-167508b6c0aa" />

- Courses page
<img width="400" alt="Screenshot 2025-05-20 at 22 18 12" src="https://github.com/user-attachments/assets/f4bb4909-f004-4e39-9ba5-66e83705a58c" />

- Courses page Edit modal 
<img width="400" alt="Screenshot 2025-05-20 at 22 18 19" src="https://github.com/user-attachments/assets/d6baaa51-ab02-4a25-b047-d3e58553ceac" />

- Courses page Delete modal 
<img width="400" alt="Screenshot 2025-05-20 at 22 18 26" src="https://github.com/user-attachments/assets/8bfe9490-377a-4b0f-8fb3-b06846996ad6" />

### Set up
- Run the server using php -S localhost:8000/[PORT] or XAMPP
- Fill in the correct db configs in db.php 
- To create and migrate the tables, run: 
  - php database/migrations/create_courses_table.php
  - php database/migrations/create_students_table.php
- To seed sample data, run:
  - php database/seeds/seed_courses.php
  - php database/seeds/seed_students.php
