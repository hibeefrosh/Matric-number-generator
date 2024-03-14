<?php
$title = 'students';
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
        <h1 class="text-2xl font-semibold md:text-3xl">Students Information</h1>

        <div class="flex w-full justify-between items-center mt-3 md:mt-0 md:w-fit">
            <p class="text-xs mr-2">Sort Department:</p>
            <select name="choose_department" id="choose-department" class="border text-xs rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border">
                <option value="0">Select Department</option>
                <?php foreach ($departments as $department) : ?>
                    <option value="<?php echo $department['department_id']; ?>">
                        <?php echo $department['department_name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>
    </div>
</div>



<div class="relative overflow-x-auto sm:rounded-lg mt-4 px-4">
    <!-- Your students.php view -->

    <!-- Table -->
    <?php if (empty($students)) : ?>
        <p>No students available.</p>
    <?php else : ?>
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-white uppercase bg-[#0D0D0D]">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Student name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Matric No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
                <?php foreach ($students as $student) : ?>
                    <tr class="bg-white border-b hover:bg-gray-50 text-[#0D0D0D]" data-department="<?php echo $student['department_id']; ?>">
                        <th scope="row" class="px-6 py-4 font-medium">
                            <?php echo htmlspecialchars($student['student_name']); ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($student['email']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($student['matric_no']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <!-- Delete Form -->
                            <form action="<?php echo $appUrl . '/delete-student'; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
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
    <?php endif; ?>


</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the select element
        const departmentSelect = document.getElementById('choose-department');
        // Get the table body
        const tableBody = document.getElementById('studentsTableBody');

        // Add an event listener to the select element
        departmentSelect.addEventListener('change', function() {
            // Get the selected department value
            const selectedDepartment = departmentSelect.value;

            // Iterate through the table rows
            Array.from(tableBody.children).forEach(row => {
                const rowDepartment = row.dataset.department;

                // Check if the row matches the selected department
                if (selectedDepartment === '0' || rowDepartment === selectedDepartment) {
                    // Show the row
                    row.style.display = '';
                } else {
                    // Hide the row
                    row.style.display = 'none';
                }
            });
        });
    });
</script>


<?php $content = ob_get_clean();

require_once BASE_PATH . '/views/layouts/admin.php';
?>