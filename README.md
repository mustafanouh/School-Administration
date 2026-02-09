🏫 School Administration System
A robust School Management System built with Laravel, Tailwind CSS, and MySQL. This system is designed to handle the complex lifecycle of students, staff, and academic progression with strict business logic.

🚀 Core Functional Modules
1. Student Admission & Enrollment
Student Identity: Personal data is stored in the Students table (Name, Guardian info, etc.). Students are treated as administrative entities and do not have User login accounts.

First Enrollment: Upon acceptance, the system automatically creates a record in the Enrollments table, linking the student to the Current Academic Year, Section, and Track.

Capacity Logic: The system strictly prevents enrollment if a Section has reached its maximum capacity defined in the database.

2. Staff & Faculty Management
General Staff: Administrative roles (Accountants, Managers, HR) are created in the Users table and linked to the Employees table with specific programmatic permissions.

Teachers: Specialized employees stored in the Teachers table to manage academic delivery.

Teacher-Subject Assignment: Teachers are assigned to specific Subjects, Sections, and Academic Years.

Integrity Rule: To prevent conflicts, the system ensures a single subject cannot be assigned to the same section by two different teachers within the same academic cycle.

3. Examination & Grading System
Exam Creation: Teachers or Admins define exams in the Exams table, associated with a Subject and a Semester.

Mark Weights: Every exam must have a defined max_mark (Maximum Grade).

Grade Validation: When recording scores in the Marks table, the system performs two critical checks:

Verifies the student is currently enrolled in the academic year associated with the exam.

Ensures the entered score does not exceed the max_mark.

4. Automatic Promotion Logic
The system automates the transition between academic years:

Success Evaluation: The system aggregates marks and compares them against the min_mark (Passing Grade) defined in the Subjects table.

Status Management: Students passing all subjects have their Enrollments status updated to "Passed".

Grade Promotion: Successful students are automatically queued for the next Grade level in the upcoming academic year.

5. Academic Year Lifecycle
Active Year Control: Only one year can be marked as is_active in the Academic_Years table.

Data Locking: Grading and enrollment modifications are restricted to the active year only.

Year Closing: Closing a year archives all current Enrollments, making them read-only to preserve historical data integrity.

🛠 Technical Stack
Framework: Laravel 11.x

Frontend: Tailwind CSS & Blade Components

Authentication: Laravel Breeze

Build Tool: Vite