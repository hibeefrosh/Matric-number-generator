<?php
$title = 'Admin dashboard';
ob_start();
if (
    session_status() == PHP_SESSION_NONE
) {
    session_start();
}
// Access configuration values from the session
if (isset($_SESSION['appName']) && isset($_SESSION['appUrl'])) {
    $appName = $_SESSION['appName'];
    $appUrl = $_SESSION['appUrl'];
}
?>
<div class="flex flex-col w-full items-left p-4">
    <div class="flex flex-col items-start space-x-0 space-y-3 justify-start rounded-lg border shadow-sm p-3 mb-5 md:flex-row md:space-x-8 md:items-center md:space-y-0">
        <!-- Display student profile picture -->
        <img src="asset/assets/Number=7.jpg" alt="Student Profile Picture" class="rounded-full w-36 self-center">

        <div class="space-y-3">
            <!-- Display student name -->
            <div class="flex flex-col space-y-1">
                <p class="text-sm text-[#141a14a2]">Student Name:</p>
                <h1 class="text-[#141A14] text-xl font-semibold"><?php echo $studentDetails['student_name'] ?? ''; ?></h1>
            </div>

            <!-- Display student email -->
            <div class="flex flex-col space-y-1">
                <p class="text-sm text-[#141a14a2]">Email:</p>
                <h1 class="text-[#141A14] text-xl font-semibold"><?php echo $studentDetails['email'] ?? ''; ?></h1>
            </div>
        </div>

        <div class="space-y-3">
            <!-- Display student department -->
            <div class="flex flex-col space-y-1">
                <p class="text-sm text-[#141a14a2]">Department:</p>
                <h1 class="text-[#141A14] text-xl font-semibold"><?php echo $departmentName ?? ''; ?></h1>
            </div>

            <!-- Display student status (you may need to fetch this from the database) -->
            <div class="flex flex-col space-y-1">
                <p class="text-sm text-[#141a14a2]">Status:</p>
                <h1 class="text-[#141A14] text-xl font-semibold">Verified Student</h1>
            </div>
        </div>
    </div>

    <div class="flex flex-col space-y- mt-6">
        <p class="md:text-xl font-medium tracking-tight">Your generated Matric No is:</p>
        <!-- Display student matric number -->
        <h1 class="text-[58px] font-bold tracking-tight ojuju md:text-8xl">
            <?php echo $studentDetails['matric_no'] ?? ''; ?>
        </h1>
    </div>
</div>

<?php $content = ob_get_clean();

require_once BASE_PATH . '/views/layouts/student.php';
?>