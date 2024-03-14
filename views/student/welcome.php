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
<div class="flex flex-col w-full items-center">
    <img src="asset/assets/success-lottie.e326cfccb912d07b5ca1.gif" class="md:w-5/12">
    <h1 class="text-lg font-semibold tracking-tight">Matric No Successfully Generated</h1>
    <a href="<?php echo $appUrl . '/dashboard'; ?>" class="my-5 w-fit flex space-x-2 items-center bg-[#6936f5] linear rounded-lg p-3 text-base text-white font-medium">
        <p>
            Continue to Dashboard
        </p>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_218_10)">
                <path d="M13.172 12L8.22198 7.04999L9.63598 5.63599L16 12L9.63598 18.364L8.22198 16.95L13.172 12Z" fill="white" />
            </g>
            <defs>
                <clipPath id="clip0_218_10">
                    <rect width="24" height="24" fill="white" />
                </clipPath>
            </defs>
        </svg>
    </a>
</div>
<?php $content = ob_get_clean();

require_once BASE_PATH . '/views/layouts/student.php';
?>