<?php

class AdminController
{
    private $pdo;

    public function __construct()
    {
        $config = require BASE_PATH . '/config/config.php';
        $dbConfig = $config['database'];

        try {
            $this->pdo = new PDO(
                "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}",
                $dbConfig['username'],
                $dbConfig['password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }


    public function login()
    {
        // Display the login form
        include BASE_PATH . '/views/admin/login.php';
    }

    public function authenticate()
    {
 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];



            $errors = [];

            if (empty($email) || empty($password)) {
                $errors[] = 'Email and password are required.';
            }

            if (empty($errors)) {
                $stmt = $this->pdo->prepare("SELECT id, password FROM admins WHERE email = ?");
                $stmt->execute([$email]);
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                // echo $admin;

                if ($admin && password_verify($password, $admin['password'])) {

                    $_SESSION['admin'] = $admin;

                    header("Location: /matricno-generator/admindashboard");
                    exit;
                } else {
                    $errors[] = 'Invalid email or password.';
                }
            }

            $_SESSION['login_errors'] = $errors;

            // Redirect back to the login page with errors
            header("Location: /matricno-generator/admin-login");
            exit;
        }
    }

    private function getTotalStudents()
    {
        // Implement logic to query the database for total students
        $stmt = $this->pdo->query('SELECT COUNT(*) FROM students');
        return $stmt->fetchColumn();
    }

    private function getAllStudents()
    {
        $stmt = $this->pdo->query('SELECT * FROM students');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function dashboard()
    {

        $totalStudents = $this->getTotalStudents();

        include BASE_PATH . '/views/admin/dashboard.php';
    }

    public function students()
    {
        $students = $this->getAllStudents();
        $departments = $this->getAllDepartments();

        include BASE_PATH . '/views/admin/students.php';
    }


    public function addDepartment()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $departmentName = $_POST['department_name'] ?? '';
            $school = $_POST['school'] ?? '';
            $departmentCode = $_POST['department_code'] ?? '';

            try {
                $stmt = $this->pdo->prepare("INSERT INTO departments (department_name, school, department_code) VALUES (?, ?, ?)");

                $stmt->execute([$departmentName, $school, $departmentCode]);


                header("Location: /matricno-generator/manage-departments");

                exit();
            } catch (PDOException $e) {
                
                $errors[] = 'An error occurred while processing the request. Please try again later.';
            }
        }

        // Include the view file
        include BASE_PATH . '/views/admin/add-department.php';
    }

    private function getAllDepartments()
    {
        $stmt = $this->pdo->query('SELECT * FROM departments');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function manageDepartments()
    {
        $allDepartments = $this->getAllDepartments();

        include BASE_PATH . '/views/admin/settings.php';
    }

    public function deleteDepartment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $submittedDepartmentId = $_POST['department_id'] ?? 0;

            try {
                $stmt = $this->pdo->prepare("DELETE FROM departments WHERE department_id = ?");
                $stmt->execute([$submittedDepartmentId]);

                header("Location: /matricno-generator/manage-departments");
                exit();
            } catch (PDOException $e) {
                
                $errors = 'An error occurred while processing the request. Please try again later.';

                header("Location: /matricno-generator/manage-departments");
                exit();
            }
        }
    }


    public function editDepartment()
    {
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $submittedDepartmentId = $_POST['department_id'] ?? 0;
            $departmentDetails = $this->getDepartmentDetails($submittedDepartmentId);

        }

        include BASE_PATH . '/views/admin/edit-department.php';
    }

    private function getDepartmentDetails($departmentId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM departments WHERE department_id = ?");
        $stmt->execute([$departmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateDepartment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $newDepartmentName = $_POST['new_department_name'] ?? '';
            $newSchool = $_POST['new_school'] ?? '';
            $newDepartmentCode = $_POST['new_department_code'] ?? '';
            $submittedDepartmentId = $_POST['department_id'] ?? 0;


            try {
               
                $stmt = $this->pdo->prepare("UPDATE departments SET department_name = ?, school = ?, department_code = ? WHERE department_id = ?");
                $stmt->execute([$newDepartmentName, $newSchool, $newDepartmentCode, $submittedDepartmentId]);

                header("Location: /matricno-generator/manage-departments");

                exit();
            } catch (PDOException $e) {
                $errors = 'An error occurred while processing the request. Please try again later.';
                header("Location: /matricno-generator/manage-departments");
                exit();
            }
        }
    }

    public function deleteStudent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentId = $_POST['student_id'] ?? 0;

            if (!filter_var($studentId, FILTER_VALIDATE_INT) || $studentId <= 0) {
                header("Location: /matricno-generator/error");
                exit();
            }

            try {
                $stmt = $this->pdo->prepare("DELETE FROM students WHERE student_id = ?");
                $stmt->execute([$studentId]);

                header("Location: /matricno-generator/students");
                exit();
            } catch (PDOException $e) {
                $errors[] = 'An error occurred while processing the request. Please try again later.';
                exit();
            }
        }
    }



    public function logout()
    {
        // Start the session
        session_start();

        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the login page or any other page
        header("Location: /matricno-generator/admin-login");
        exit;
    }
}
