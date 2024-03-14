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
    <h1 class="text-2xl font-semibold md:text-3xl tracking-tight">Edit Department</h1>
</div>

<form method="post" action="<?php echo $appUrl ?>/update-department">
    <input type="hidden" name="department_id" value="<?php echo $departmentDetails['department_id'] ?? ''; ?>">
    <div class="px-4 grid grid-cols-1 md:grid-cols-2 gap-4 w-full justify-between">
        <div class="w-full">
            <label for="new_department_name" class="block mt-4 mb-2 font-semibold text-base">Department Name</label>
            <input type="text" id="new_department_name" name="new_department_name" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Enter department name" value="<?php echo $departmentDetails['department_name'] ?? ''; ?>">
        </div>

        <div class="w-full">
            <label for="new_school" class="block mt-4 mb-2 font-semibold text-base">School</label>
            <input type="text" id="new_school" name="new_school" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Enter school name" value="<?php echo $departmentDetails['school'] ?? ''; ?>">
        </div>

        <div class="w-full">
            <label for="new_department_code" class="block mt-4 mb-2 font-semibold text-base">Department Code</label>
            <input type="text" id="new_department_code" name="new_department_code" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Enter department code" value="<?php echo $departmentDetails['department_code'] ?? ''; ?>">
        </div>
    </div>

    <button type="submit" class="m-4 flex w-fit items-center p-3 px-6 text-gray-900 rounded-md bg-[#0D0D0D] linear">
        <span class="ms-3 text-white pr-3">Finish Editing</span>
    </button>
</form>


<?php $content = ob_get_clean();

require_once BASE_PATH . '/views/layouts/admin.php';
?>