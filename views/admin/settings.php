<?php
$title = 'Manage-departments';
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
    <div class="flex flex-col w-full items-start justify-between md:flex-row md:items-start">
        <h1 class="text-2xl font-semibold md:text-3xl tracking-tight">Departments</h1>

        <a href="<?php echo $appUrl . '/add-department'; ?>" class="flex items-center p-2 text-gray-900 rounded-md bg-[#0D0D0D] linear">
            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.4" d="M16.19 2.5H7.81C4.17 2.5 2 4.67 2 8.31V16.68C2 20.33 4.17 22.5 7.81 22.5H16.18C19.82 22.5 21.99 20.33 21.99 16.69V8.31C22 4.67 19.83 2.5 16.19 2.5Z" fill="#fff" />
                <path d="M18 11.75H12.75V6.5C12.75 6.09 12.41 5.75 12 5.75C11.59 5.75 11.25 6.09 11.25 6.5V11.75H6C5.59 11.75 5.25 12.09 5.25 12.5C5.25 12.91 5.59 13.25 6 13.25H11.25V18.5C11.25 18.91 11.59 19.25 12 19.25C12.41 19.25 12.75 18.91 12.75 18.5V13.25H18C18.41 13.25 18.75 12.91 18.75 12.5C18.75 12.09 18.41 11.75 18 11.75Z" fill="#fff" />
            </svg>
            <span class="ms-3 text-white pr-3">Add Department</span>
        </a>
    </div>
</div>

<div class="relative overflow-x-auto sm:rounded-lg mt-4 px-4">
    <table class="w-full text-sm text-left">
        <thead class="text-xs text-white uppercase bg-[#0D0D0D]">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Department name
                </th>
                <th scope="col" class="px-6 py-3">
                    School
                </th>
                <th scope="col" class="px-6 py-3">
                    Department Code
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allDepartments as $department) : ?>
                <tr class="bg-white border-b hover:bg-gray-50 text-[#0D0D0D]">
                    <th scope="row" class="px-6 py-4 font-medium">
                        <?php echo $department['department_name']; ?>
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium">
                        <?php echo $department['school']; ?>
                    </th>
                    <td class="px-6 py-4 font-semibold">
                        <?php echo $department['department_code']; ?>
                    </td>
                    <td class="px-6 py-4 flex space-x-4">
                        <form method="post" action="<?php echo $appUrl . '/edit-department'; ?>">
                            <input type="hidden" name="department_id" value="<?php echo $department['department_id']; ?>">
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M15.48 3.5H7.52C4.07 3.5 2 5.56 2 9.02V16.97C2 20.44 4.07 22.5 7.52 22.5H15.47C18.93 22.5 20.99 20.44 20.99 16.98V9.02C21 5.56 18.93 3.5 15.48 3.5Z" fill="#07DF74" />
                                    <path d="M21.02 3.48003C19.23 1.68003 17.48 1.64003 15.64 3.48003L14.51 4.60003C14.41 4.70003 14.38 4.84003 14.42 4.97003C15.12 7.42003 17.08 9.38003 19.53 10.08C19.56 10.09 19.61 10.09 19.64 10.09C19.74 10.09 19.84 10.05 19.91 9.98003L21.02 8.86003C21.93 7.95003 22.38 7.08003 22.38 6.19003C22.38 5.29003 21.93 4.40003 21.02 3.48003Z" fill="#07DF74" />
                                    <path d="M17.86 10.92C17.59 10.79 17.33 10.66 17.09 10.51C16.89 10.39 16.69 10.26 16.5 10.12C16.34 10.02 16.16 9.86997 15.98 9.71997C15.96 9.70997 15.9 9.65997 15.82 9.57997C15.51 9.32997 15.18 8.98997 14.87 8.61997C14.85 8.59997 14.79 8.53997 14.74 8.44997C14.64 8.33997 14.49 8.14997 14.36 7.93997C14.25 7.79997 14.12 7.59997 14 7.38997C13.85 7.13997 13.72 6.88997 13.6 6.62997C13.47 6.34997 13.37 6.08997 13.28 5.83997L7.9 11.22C7.55 11.57 7.21 12.23 7.14 12.72L6.71 15.7C6.62 16.33 6.79 16.92 7.18 17.31C7.51 17.64 7.96 17.81 8.46 17.81C8.57 17.81 8.68 17.8 8.79 17.79L11.76 17.37C12.25 17.3 12.91 16.97 13.26 16.61L18.64 11.23C18.39 11.15 18.14 11.04 17.86 10.92Z" fill="#07DF74" />
                                </svg>
                            </button>
                        </form>

                        <form method="post" action="<?php echo $appUrl . '/delete-department'; ?>" onsubmit="return confirm('Are you sure you want to delete this department?');">
                            <input type="hidden" name="department_id" value="<?php echo $department['department_id']; ?>">
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.07 5.73C19.46 5.57 17.85 5.45 16.23 5.36V5.35L16.01 4.05C15.86 3.13 15.64 1.75 13.3 1.75H10.68C8.35 1.75 8.13 3.07 7.97 4.04L7.76 5.32C6.83 5.38 5.9 5.44 4.97 5.53L2.93 5.73C2.51 5.77 2.21 6.14 2.25 6.55C2.29 6.96 2.65 7.26 3.07 7.22L5.11 7.02C10.35 6.5 15.63 6.7 20.93 7.23C20.96 7.23 20.98 7.23 21.01 7.23C21.39 7.23 21.72 6.94 21.76 6.55C21.79 6.14 21.49 5.77 21.07 5.73Z" fill="#E5301B" />
                                    <path opacity="0.3991" d="M19.23 8.64C18.99 8.39 18.66 8.25 18.32 8.25H5.68C5.34 8.25 5 8.39 4.77 8.64C4.54 8.89 4.41 9.23 4.43 9.58L5.05 19.84C5.16 21.36 5.3 23.26 8.79 23.26H15.21C18.7 23.26 18.84 21.37 18.95 19.84L19.57 9.59C19.59 9.23 19.46 8.89 19.23 8.64Z" fill="#E5301B" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.58 17.5C9.58 17.0858 9.91579 16.75 10.33 16.75H13.66C14.0742 16.75 14.41 17.0858 14.41 17.5C14.41 17.9142 14.0742 18.25 13.66 18.25H10.33C9.91579 18.25 9.58 17.9142 9.58 17.5Z" fill="#E5301B" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.75 13.5C8.75 13.0858 9.08579 12.75 9.5 12.75H14.5C14.9142 12.75 15.25 13.0858 15.25 13.5C15.25 13.9142 14.9142 14.25 14.5 14.25H9.5C9.08579 14.25 8.75 13.9142 8.75 13.5Z" fill="#E5301B" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php $content = ob_get_clean();

require_once BASE_PATH . '/views/layouts/admin.php';
?>