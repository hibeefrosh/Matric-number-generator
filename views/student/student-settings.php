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
    <div class="flex flex-col items-start w-full p-4">
        <h1 class="text-2xl font-semibold md:text-3xl tracking-tight">Edit Profile</h1>
    </div>
    <?php
    $errors = isset($_SESSION['profile_update_errors']) ? $_SESSION['profile_update_errors'] : [];
    unset($_SESSION['profile_update_errors']);
    ?>
    <?php if (!empty($errors)) : ?>
        <div class="text-red-500 bg-red-100 p-3 mb-4 border border-red-400 rounded">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="<?php echo $appUrl . '/updateprofile'; ?>">
        <div class="px-4 grid grid-cols-1 md:grid-cols-2 gap-4 w-full justify-between">
            <div class="w-full">
                <label for="surname" class="block mt-4 mb-2 font-semibold text-base">Student name</label>
                <input type="name" id="surname" name="surname" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Afolabi" value="<?php echo htmlspecialchars($userDetails['student_name'] ?? ''); ?>">
            </div>

            <div class="w-full">
                <label for="email" class="block mt-4 mb-2 font-semibold text-base">Email</label>
                <input type="email" id="email" name="email" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="olagoldlanre@gmail.com" value="<?php echo htmlspecialchars($userDetails['email'] ?? ''); ?>">
            </div>

            <div class="w-full">
                <label for="department_name" class="block mt-4 mb-2 font-semibold text-base">Department</label>
                <input type="name" id="department_name" name="department_name" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Computer Science" value="<?php echo htmlspecialchars($userDetails['department_name'] ?? ''); ?>" disabled>
            </div>

            <div class="mt-5"></div>
        </div>

        <div class="p-4">
            <h1 class="text-2xl font-semibold md:text-3xl tracking-tight">Change Password</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full justify-between">
                <div class="w-full">
                    <label for="old_password" class="block mt-4 mb-2 font-semibold text-base">Old Password</label>
                    <input type="password" id="old_password" name="old_password" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Enter your old password">
                </div>

                <div class="w-full">
                    <label for="new_password" class="block mt-4 mb-2 font-semibold text-base">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Enter your new password">
                </div>
            </div>
        </div>

        <button type="submit" class="m-4 flex w-fit items-center p-3 px-6 text-gray-900 rounded-md bg-[#6936F5] linear">
            <span class="ms-3 text-white pr-3">Finish Editing</span>
        </button>
    </form>

</div>
<?php $content = ob_get_clean();

require_once BASE_PATH . '/views/layouts/student.php';
?>