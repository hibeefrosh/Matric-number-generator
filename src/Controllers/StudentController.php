<?php
class StudentController
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


    public function index()
    {

        include BASE_PATH . '/views/student/login.php';
    }

    public function welcome()
    {

        include BASE_PATH . '/views/student/welcome.php';
    }

    public function settings()
    {
        $email = $_SESSION['user_email'] ?? '';

        if (!empty($email)) {
            $userDetails = $this->getUserDetails($email);
        } else {
            header("Location: /matricno-generator/login");
            exit();
        }

        include BASE_PATH . '/views/student/student-settings.php';
    }

    private function getUserDetails($email)
    {
        $stmt = $this->pdo->prepare("SELECT students.*, departments.department_name 
                                 FROM students
                                 JOIN departments ON students.department_id = departments.department_id
                                 WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function dashboard()
    {
        if (isset($_SESSION['user_email'])) {
            $email = $_SESSION['user_email'];

            $stmt = $this->pdo->prepare("SELECT * FROM students WHERE email = ?");
            $stmt->execute([$email]);
            $studentDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($studentDetails) {
                $departmentId = $studentDetails['department_id'];
                $departmentName = $this->getDepartmentName($departmentId);

                include BASE_PATH . '/views/student/dashboard.php';
            } else {
                header("Location: /matricno-generator/login");
                exit();
            }
        } else {
            header("Location: /matricno-generator/login");
            exit();
        }
    }

    private function getDepartmentName($departmentId)
    {
        $stmt = $this->pdo->prepare("SELECT department_name FROM departments WHERE department_id = ?");
        $stmt->execute([$departmentId]);
        $department = $stmt->fetch(PDO::FETCH_ASSOC);

        return $department ? $department['department_name'] : 'Unknown Department';
    }



    public function signupForm()
    {
        // Fetch all departments for populating the select dropdown
        $departments = $this->getAllDepartments();

        include BASE_PATH . '/views/student/signup.php';
    }

    private function getAllDepartments()
    {
        $stmt = $this->pdo->query('SELECT * FROM departments');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $surname = $_POST['surname'] ?? '';
            $firstName = $_POST['first_name'] ?? '';
            $departmentId = $_POST['choose_department'] ?? 0;
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $errors = [];

            if (empty($surname)) {
                $errors[] = 'Surname is required.';
            }

            if (empty($firstName)) {
                $errors[] = 'First Name is required.';
            }

            if (!filter_var($departmentId, FILTER_VALIDATE_INT) || $departmentId <= 0) {
                $errors[] = 'Invalid Department ID.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email address.';
            }

            if (strlen($password) < 8) {
                $errors[] = 'Password must be at least 8 characters long.';
            }

            // Check if the email is already taken
            $stmt = $this->pdo->prepare("SELECT COUNT(*) AS email_count FROM students WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['email_count'] > 0) {
                $errors[] = 'Email is already taken. Please choose another one.';
            }
            $_SESSION['signup_errors'] = $errors;
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Generate student name and matric number
            $studentName = $this->generateStudentName($surname, $firstName);
            $matric_no = $this->generateMatricNo($departmentId);

            try {
                // Insert user data into the database
                $stmt = $this->pdo->prepare("INSERT INTO students (student_name, department_id, email, matric_no, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$studentName, $departmentId, $email, $matric_no, $hashedPassword]);

                $_SESSION['user_name'] = $studentName;
                $_SESSION['user_email'] = $email;

                // Redirect to a success page or perform other actions
                header("Location: /matricno-generator/welcome");
                exit();
            } catch (PDOException $e) {
                $errors[] = 'An error occurred while processing the request. Please try again later.';
                $_SESSION['signup_errors'] = $errors;
            }

            // Redirect in case of any error
            header("Location: /matricno-generator/signup");
            exit();
        }
    }

    private function generateStudentName($surname, $firstName)
    {

        return $firstName . ' ' . $surname;
    }

    private function generateMatricNo($departmentId)
    {

        $currentYear = date('y') % 100;

        $stmt = $this->pdo->prepare("SELECT department_code FROM departments WHERE department_id = ?");
        $stmt->execute([$departmentId]);
        $department = $stmt->fetch(PDO::FETCH_ASSOC);

        $departmentCode = $department['department_code'];

        $stmt = $this->pdo->prepare("SELECT COUNT(student_id) AS student_count FROM students WHERE department_id = ?");
        $stmt->execute([$departmentId]);
        $studentCountRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $studentCount = $studentCountRow['student_count'];

        $nextStudentId = $studentCount + 1;

        $matricNo = $currentYear . '/' . $departmentCode . '/' . str_pad($nextStudentId, 4, '0', STR_PAD_LEFT);
        return $matricNo;
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $errors = [];

            // Validate form data
            if (empty($email)) {
                $errors[] = 'Email is required.';
            }

            if (empty($password)) {
                $errors[] = 'Password is required.';
            }


            if (empty($errors)) {
                try {

                    $stmt = $this->pdo->prepare("SELECT * FROM students WHERE email = ?");
                    $stmt->execute([$email]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
                        $_SESSION['user_name'] = $user['student_name'];
                        $_SESSION['user_email'] = $email;

                        header("Location: /matricno-generator/dashboard");
                        exit();
                    } else {
                        $errors[] = 'Invalid email or password.';
                    }
                } catch (PDOException $e) {
                    $errors[] = 'An error occurred while processing the request. Please try again later.';
                }
            }

            // Set errors in session and redirect back to the login page
            $_SESSION['login_errors'] = $errors;
            header("Location: /matricno-generator/login");
            exit();
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
        header("Location: /matricno-generator/login");
        exit;
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['surname'] ?? '';
            $email = $_POST['email'] ?? '';
            $oldPassword = $_POST['old_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';

            $errors = [];


            $emailInSession = $_SESSION['user_email'] ?? '';
            $stmt = $this->pdo->prepare("SELECT * FROM students WHERE email = ?");
            $stmt->execute([$emailInSession]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($oldPassword, $user['password'])) {



                // Update the user's password if a new password is provided
                $hashedNewPassword = empty($newPassword) ? $user['password'] : password_hash($newPassword, PASSWORD_DEFAULT);

                try {
                    // Update user data in the database
                    $stmt = $this->pdo->prepare("UPDATE students SET student_name = ?,email = ?, password = ? WHERE email = ?");
                    $stmt->execute([$firstName, $email, $hashedNewPassword, $emailInSession]);
                    $_SESSION['user_email'] = $email;

                    // Redirect to a success page or perform other actions
                    header("Location: /matricno-generator/dashboard");
                    exit();
                } catch (PDOException $e) {
                    $errors[] = 'An error occurred while processing the request. Please try again later.';
                }
            } else {
                $errors[] = 'Invalid old password.';
            }

            // Redirect in case of any error
            $_SESSION['profile_update_errors'] = $errors;
            header("Location: /matricno-generator/studentsettings");
            exit();
        }
    }
}
