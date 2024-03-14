<?php
$title = 'Add-department';
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
    <h1 class="text-2xl font-semibold md:text-3xl tracking-tight">Add a new Department</h1>
</div>

<!-- add-department.php -->

<div class="px-4 grid grid-cols-1 md:grid-cols-2 gap-4 w-full justify-between">
    <form action="<?php echo $appUrl ?>/add-department" method="post" class="w-full">
        <div class="w-full">
            <label for="department_name" class="block mt-4 mb-2 font-semibold text-base">Department Name</label>
            <input type="text" name="department_name" id="department_name" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Enter department name" required>
        </div>

        <div class="w-full">
            <label for="school" class="block mt-4 mb-2 font-semibold text-base">School</label>
            <input type="text" name="school" id="school" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Enter school name" required>
        </div>

        <div class="w-full">
            <label for="department_code" class="block mt-4 mb-2 font-semibold text-base">Set Department Code</label>
            <input type="text" name="department_code" id="department_code" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Set a department code" required>
        </div>

        <button type="submit" class="m-4 flex w-fit items-center p-3 px-6 text-gray-900 rounded-md bg-[#0D0D0D] linear">
            <span class="ms-3 text-white pr-3">Finish Adding</span>
        </button>
    </form>
</div>

<?php $content = ob_get_clean();

require_once BASE_PATH . '/views/layouts/admin.php';
?>