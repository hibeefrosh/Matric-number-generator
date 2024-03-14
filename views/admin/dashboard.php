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
<div class="flex flex-col items-start w-full p-4">
    <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
        <div class="md:w-4/6">
            <a href="<?php echo $appUrl . '/students'; ?>">
                <img src="asset/assets/admin-image.png" alt="">
            </a>
        </div>
        <div class="md:w-2/6 flex flex-col space-y-3 justify-between bg-[#0D0D0D] rounded-[8px] text-white p-3 py-5">
            <div class="space-y-2">
                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M24.8342 11.0075C24.735 10.9934 24.6358 10.9934 24.5367 11.0075C22.3408 10.9367 20.5983 9.13754 20.5983 6.92754C20.5983 4.67504 22.4258 2.83337 24.6925 2.83337C26.945 2.83337 28.7867 4.66087 28.7867 6.92754C28.7725 9.13754 27.03 10.9367 24.8342 11.0075Z" fill="white" />
                    <path opacity="0.4" d="M29.4525 20.8249C27.8658 21.8874 25.6417 22.2841 23.5875 22.0149C24.1258 20.8533 24.4092 19.5641 24.4233 18.2041C24.4233 16.7875 24.1117 15.4416 23.5167 14.2658C25.6133 13.9825 27.8375 14.3791 29.4383 15.4416C31.6767 16.9149 31.6767 19.3374 29.4525 20.8249Z" fill="white" />
                    <path opacity="0.4" d="M9.12333 11.0075C9.2225 10.9934 9.32167 10.9934 9.42084 11.0075C11.6167 10.9367 13.3592 9.13754 13.3592 6.92754C13.3592 4.67504 11.5317 2.83337 9.265 2.83337C7.0125 2.83337 5.17084 4.66087 5.17084 6.92754C5.185 9.13754 6.9275 10.9367 9.12333 11.0075Z" fill="white" />
                    <path opacity="0.4" d="M9.27916 18.2042C9.27916 19.5783 9.57666 20.8817 10.115 22.0575C8.1175 22.27 6.035 21.845 4.505 20.8392C2.26666 19.3517 2.26666 16.9291 4.505 15.4416C6.02083 14.4216 8.16 14.0108 10.1717 14.2375C9.59083 15.4275 9.27916 16.7733 9.27916 18.2042Z" fill="white" />
                    <path d="M17.17 22.4825C17.0567 22.4683 16.9292 22.4683 16.8017 22.4825C14.195 22.3975 12.1125 20.2583 12.1125 17.6233C12.1125 14.9317 14.28 12.75 16.9858 12.75C19.6775 12.75 21.8592 14.9317 21.8592 17.6233C21.8592 20.2583 19.7908 22.3975 17.17 22.4825Z" fill="white" />
                    <path d="M12.5658 25.415C10.4267 26.8458 10.4267 29.1975 12.5658 30.6142C15.0025 32.2433 18.9975 32.2433 21.4342 30.6142C23.5733 29.1833 23.5733 26.8317 21.4342 25.415C19.0117 23.7858 15.0167 23.7858 12.5658 25.415Z" fill="white" />
                </svg>
                <p>Total Students Registered</p>
            </div>
            <h1 class="text-3xl font-bold ojuju md:text-6xl"><?php echo $totalStudents; ?></h1>
        </div>
    </div>
</div>


<?php $content = ob_get_clean();

require_once BASE_PATH . '/views/layouts/admin.php';
?>