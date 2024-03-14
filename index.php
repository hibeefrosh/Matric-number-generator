<?php
$config = require __DIR__ . '/config/config.php';
// Accessing app configuration
$appConfig = $config['app'];
$appName = $appConfig['name'];
$appUrl = $appConfig['url'];

// Store values in the session
session_start();
$_SESSION['appName'] = $appName;
$_SESSION['appUrl'] = $appUrl;


define('BASE_PATH', __DIR__);
$request = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

//  base path
$basePath = '/matricno-generator';

// Routes that require authentication
$authenticatedRoutes = [
    $basePath . '/admindashboard',
    $basePath . '/students',
    $basePath . '/logout',
    $basePath . '/manage-departments',
    $basePath . '/edit-department',
    $basePath .'/delete-department',
    $basePath . '/add-department',
    $basePath . '/update-department',
    $basePath . '/delete-student',



];

// Check if the current route requires authentication
if (in_array($request, $authenticatedRoutes) && !isset($_SESSION['admin'])) {
    // Redirect to the login page or perform any other authentication logic
    header("Location: $basePath/admin-login");
    exit;
}

// Routes that require student authentication
$studentAuthenticatedRoutes = [
    $basePath . '/dashboard',
    $basePath . '/welcome',
    $basePath . '/studentsettings',
    $basePath . '/signout',
    $basePath . '/studentsettings',
    $basePath . '/updateprofile',


];

// Check if the current route requires student authentication
if (in_array($request, $studentAuthenticatedRoutes) && !isset($_SESSION['user_email'])) {
    // Redirect to the login page or perform any other authentication logic
    header("Location: $basePath/login");
    exit;
}


// Define allowed routes
$allowedRoutes = [
    $basePath . '/',
    $basePath . '/login',
    $basePath . '/signup',
    $basePath . '/register',
    $basePath . '/validate',
    $basePath . '/students',
    $basePath . '/issue-card',
    $basePath . '/admin-login',
    $basePath . '/admin-login/authenticate',
    $basePath . '/admindashboard',
    $basePath . '/update-department',
    $basePath . '/logout',
    $basePath . '/manage-departments',
    $basePath . '/add-department',
    $basePath . '/delete-department',
    $basePath . '/edit-department',
    $basePath . '/dashboard',
    $basePath . '/welcome',
    $basePath . '/signout',
    $basePath . '/studentsettings',
    $basePath . '/updateprofile',
    $basePath . '/delete-student',

];

// Validate against the whitelist
if (!in_array($request, $allowedRoutes)) {
    // Log the error
    error_log('404 Not Found - ' . $_SERVER['REQUEST_URI']);

    // Respond with a generic message
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
    exit;
}


// Switch based on the validated request URI
switch ($request) {
    case $basePath . '/':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->index();
        break;
    case $basePath . '/login':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->index();
        break;
    case $basePath . '/signup':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->signupForm();
        break;
    case $basePath . '/admin-login':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->login();
        break;
    case $basePath . '/admin-login/authenticate':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->authenticate();
        break;
    case $basePath . '/admindashboard':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->dashboard();
        break;
    case $basePath . '/students':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->students();
        break;
    case $basePath . '/manage-departments':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->manageDepartments();
        break;
    case $basePath . '/add-department':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->addDepartment();
        break;
    case $basePath . '/register':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->register();
        break;
    case $basePath . '/logout':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->logout();
        break;
    case $basePath . '/signout':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->logout();
        break;
    case $basePath . '/delete-department':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->deleteDepartment();
        break;
    case $basePath . '/delete-student':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->deleteStudent();
        break;
    case $basePath . '/edit-department':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->editDepartment();
        break;
    case $basePath . '/validate':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->login();
        break;
    case $basePath . '/dashboard':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->dashboard();
        break;
    case $basePath . '/welcome':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->welcome();
        break;
    case $basePath . '/update-department':
        require __DIR__ . '/src/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->updateDepartment();
        break;
    case $basePath . '/studentsettings':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->settings();
        break;
    case $basePath . '/updateprofile':
        require __DIR__ . '/src/Controllers/StudentController.php';
        $controller = new StudentController();
        $controller->updateProfile();
        break;
    default:
        // Log the error
        error_log('404 Not Found - ' . $_SERVER['REQUEST_URI']);

        // Respond with a generic message
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
        break;
}
