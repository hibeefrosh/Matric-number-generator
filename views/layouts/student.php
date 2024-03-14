<?php

if (
    session_status() == PHP_SESSION_NONE
) {
    session_start();
}
// Access configuration values from the session
if (isset($_SESSION['appName']) && isset($_SESSION['appUrl'])) {
    $appName = $_SESSION['appName'];
    $appUrl = $_SESSION['appUrl'];
} else {
    // Handle the case where session values are not set
    // You may want to redirect to the index page or set default values
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="asset/input.css">
    <link rel="icon" type="image/svg" href="asset/assets/favicon.svg" />
    <title><?php echo isset($title) ? $title : 'matricno-generator'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>

    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
        <div class="ml-2"></div>
        <svg width="113" height="26" viewBox="0 0 113 26" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.2271 10.7518L14.789 12.5915C14.6269 12.6378 14.4799 12.7259 14.3627 12.8471C14.2455 12.9682 14.1623 13.118 14.1213 13.2815L13.625 15.2701C13.5839 15.4336 13.5007 15.5834 13.3835 15.7046C13.2663 15.8257 13.1193 15.9139 12.9573 15.9602L6.78651 17.7183C6.62427 17.7647 6.47715 17.8531 6.35995 17.9746C6.24274 18.096 6.15958 18.2461 6.11885 18.4099L5.28147 21.7387C5.27472 21.766 5.27529 21.7946 5.28311 21.8216C5.29094 21.8486 5.30574 21.8731 5.32602 21.8926C5.34632 21.9121 5.37137 21.9258 5.39869 21.9325C5.426 21.9392 5.4546 21.9387 5.48161 21.9308L11.9181 20.0911C12.0802 20.0447 12.2272 19.9566 12.3444 19.8354C12.4616 19.7144 12.5449 19.5645 12.5858 19.4011L13.0821 17.4173C13.1232 17.2538 13.2064 17.1039 13.3236 16.9828C13.4408 16.8616 13.5878 16.7735 13.7498 16.7271L19.9206 14.9659C20.0828 14.9194 20.2299 14.831 20.3471 14.7096C20.4644 14.5882 20.5475 14.438 20.5883 14.2742L21.4256 10.9471C21.433 10.9197 21.4329 10.8909 21.4254 10.8636C21.418 10.8363 21.4034 10.8114 21.3832 10.7916C21.3631 10.7717 21.338 10.7576 21.3106 10.7506C21.2831 10.7436 21.2543 10.744 21.2271 10.7518Z" fill="url(#paint0_linear_222_14)" />
            <path d="M21.2271 4.06246L14.789 5.90855C14.6269 5.95491 14.4799 6.04307 14.3627 6.1642C14.2455 6.28533 14.1623 6.43516 14.1213 6.59866L13.625 8.58246C13.5839 8.74593 13.5007 8.89576 13.3835 9.01685C13.2663 9.13801 13.1193 9.22615 12.9573 9.2725L6.78651 11.0354C6.62427 11.0818 6.47715 11.1702 6.35995 11.2917C6.24274 11.4131 6.15958 11.5633 6.11885 11.727L5.28147 15.0558C5.27472 15.0831 5.27529 15.1117 5.28311 15.1387C5.29094 15.1657 5.30574 15.1902 5.32602 15.2097C5.34632 15.2292 5.37137 15.2429 5.39869 15.2497C5.426 15.2564 5.4546 15.2558 5.48161 15.248L11.9181 13.4083C12.0802 13.3619 12.2272 13.2737 12.3444 13.1526C12.4616 13.0314 12.5449 12.8816 12.5858 12.7181L13.0821 10.7343C13.1232 10.5709 13.2064 10.421 13.3236 10.2999C13.4408 10.1788 13.5878 10.0906 13.7498 10.0442L19.9206 8.283C20.0845 8.23672 20.2331 8.14767 20.3513 8.02502C20.4695 7.90236 20.5529 7.75046 20.593 7.58497L21.4256 4.25619C21.4326 4.22895 21.4322 4.20035 21.4246 4.17328C21.417 4.14621 21.4025 4.12161 21.3823 4.10198C21.3622 4.08234 21.3373 4.06835 21.31 4.06141C21.2827 4.05447 21.2541 4.05483 21.2271 4.06246Z" fill="url(#paint1_linear_222_14)" />
            <path d="M33.224 19V6.22H36.788L40.208 16.012H40.226L43.628 6.22H47.192V19H44.726V9.622H44.69L41.36 19H39.056L35.726 9.622H35.69V19H33.224ZM51.406 19.216C49.66 19.216 48.436 18.208 48.436 16.588C48.436 14.95 49.714 13.816 52.108 13.564L53.566 13.402C53.998 13.366 54.322 13.078 54.322 12.574C54.322 11.8 53.638 11.314 52.72 11.314C51.604 11.314 50.884 12.16 50.848 13.132L48.688 12.628C48.76 10.882 50.362 9.514 52.738 9.514C55.114 9.514 56.608 10.882 56.608 12.934V19H54.52L54.268 17.722H54.25C53.674 18.676 52.666 19.216 51.406 19.216ZM52.27 17.434C53.422 17.434 54.268 16.57 54.268 15.292V14.824L52.648 15.004C51.37 15.148 50.794 15.67 50.794 16.354C50.794 17.038 51.406 17.434 52.27 17.434ZM61.7969 19.288C59.8889 19.288 58.7729 18.154 58.7729 16.354V11.62H57.1889V9.82H58.7729V7.336L61.1129 6.814V9.82H64.2269V11.62H61.1129V15.94C61.1129 16.822 61.5269 17.344 62.2289 17.344C62.8949 17.344 63.3989 16.948 63.6149 15.976L64.7489 17.218C64.3889 18.532 63.2729 19.288 61.7969 19.288ZM70.0963 9.55C71.6083 9.55 72.5443 10.684 72.6163 12.646L70.6363 13.204C70.5823 12.034 70.1323 11.386 69.4123 11.386C68.4763 11.386 67.9183 12.376 67.9183 14.068V19H65.5603V9.82H67.4683L67.7563 11.35H67.7743C68.1883 10.216 69.0523 9.55 70.0963 9.55ZM74.9643 8.398C74.1003 8.398 73.5063 7.822 73.5063 6.958C73.5063 6.112 74.1003 5.536 74.9643 5.536C75.8463 5.536 76.4403 6.112 76.4403 6.958C76.4403 7.822 75.8463 8.398 74.9643 8.398ZM73.7763 19V9.82H76.1343V19H73.7763ZM81.9094 19.306C79.1914 19.306 77.4454 17.398 77.4634 14.41C77.4634 11.422 79.1374 9.514 81.6754 9.514C83.7274 9.514 85.2214 10.774 85.6174 12.79L83.4394 13.312C83.2054 12.124 82.5214 11.458 81.6934 11.458C80.5594 11.458 79.8034 12.574 79.8034 14.41C79.8034 16.246 80.6674 17.362 81.9274 17.362C83.0074 17.362 83.7994 16.534 83.9974 15.148L86.1754 15.544C85.8514 17.83 84.1954 19.306 81.9094 19.306ZM90.9499 19V6.22H94.2619L98.8339 15.796H98.8699V6.22H101.354V19H98.0599L93.4699 9.442H93.4339V19H90.9499ZM107.309 19.306C104.555 19.306 102.773 17.38 102.773 14.392C102.773 11.422 104.555 9.514 107.309 9.514C110.063 9.514 111.845 11.422 111.845 14.392C111.845 17.38 110.063 19.306 107.309 19.306ZM107.309 17.29C108.641 17.29 109.505 16.174 109.505 14.392C109.505 12.628 108.641 11.53 107.309 11.53C105.959 11.53 105.113 12.628 105.113 14.392C105.113 16.174 105.959 17.29 107.309 17.29Z" fill="#6936F5" />
            <defs>
                <linearGradient id="paint0_linear_222_14" x1="13.3539" y1="10.7456" x2="13.3539" y2="21.9372" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#6936F5" />
                    <stop offset="1" stop-color="#3D208F" />
                </linearGradient>
                <linearGradient id="paint1_linear_222_14" x1="13.3537" y1="4.05646" x2="13.3537" y2="15.2543" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#6936F5" />
                    <stop offset="1" stop-color="#3D208F" />
                </linearGradient>
            </defs>
        </svg>
    </button>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto md:bg-[#f9fafc17] bg-[#FFFFFF] border border-l-1">
            <a href="#" class="flex items-center ps-2.5 mb-5">
                <img src="asset/assets/Logo1.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
            </a>
            <hr class="mt-3 mb-5 opacity-50">
            <ul class="space-y-3 font-medium">
                <li>
                    <a href="<?php echo $appUrl . '/dashboard'; ?>" class="flex items-center p-2 text-gray-900 rounded-md bg-[#6936f5] linear">
                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M17.1142 2.33337H15.3725C13.3742 2.33337 12.32 3.38754 12.32 5.38587V7.12754C12.32 9.12587 13.3742 10.18 15.3725 10.18H17.1142C19.1125 10.18 20.1667 9.12587 20.1667 7.12754V5.38587C20.1667 3.38754 19.1125 2.33337 17.1142 2.33337Z" fill="#fff" />
                            <path opacity="0.4" d="M6.63666 12.8108H4.895C2.8875 12.8108 1.83333 13.865 1.83333 15.8633V17.605C1.83333 19.6125 2.8875 20.6666 4.88583 20.6666H6.6275C8.62583 20.6666 9.68 19.6125 9.68 17.6141V15.8725C9.68917 13.865 8.635 12.8108 6.63666 12.8108Z" fill="#fff" />
                            <path d="M5.76583 10.1984C7.93769 10.1984 9.69833 8.43773 9.69833 6.26587C9.69833 4.09401 7.93769 2.33337 5.76583 2.33337C3.59397 2.33337 1.83333 4.09401 1.83333 6.26587C1.83333 8.43773 3.59397 10.1984 5.76583 10.1984Z" fill="#fff" />
                            <path d="M16.2342 20.6666C18.406 20.6666 20.1667 18.906 20.1667 16.7341C20.1667 14.5623 18.406 12.8016 16.2342 12.8016C14.0623 12.8016 12.3017 14.5623 12.3017 16.7341C12.3017 18.906 14.0623 20.6666 16.2342 20.6666Z" fill="#fff" />
                        </svg>
                        <span class="ms-3 text-white">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $appUrl . '/studentsettings'; ?>" class="flex items-center p-2 text-gray-900 rounded-md hover:bg-[#141a1409]">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12.5C14.7614 12.5 17 10.2614 17 7.5C17 4.73858 14.7614 2.5 12 2.5C9.23858 2.5 7 4.73858 7 7.5C7 10.2614 9.23858 12.5 12 12.5Z" fill="#8D96AC" />
                            <path opacity="0.4" d="M12 15C6.99 15 2.90997 18.36 2.90997 22.5C2.90997 22.78 3.12997 23 3.40997 23H20.59C20.87 23 21.09 22.78 21.09 22.5C21.09 18.36 17.01 15 12 15Z" fill="#8D96AC" />
                            <path d="M21.43 15.2401C20.53 14.3401 19.82 14.6301 19.21 15.2401L15.67 18.7801C15.53 18.9201 15.4 19.1801 15.37 19.3701L15.18 20.7201C15.11 21.2101 15.45 21.5501 15.94 21.4801L17.29 21.2901C17.48 21.2601 17.75 21.1301 17.88 20.9901L21.42 17.4501C22.04 16.8501 22.33 16.1401 21.43 15.2401Z" fill="#8D96AC" />
                        </svg>
                        <span class="ms-3 text-[#141A14]">Student Settings</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $appUrl . '/signout'; ?>" class="flex items-center p-2 text-gray-900 rounded-md hover:bg-[#141a1409]">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M12 22.5C17.5228 22.5 22 18.0228 22 12.5C22 6.97715 17.5228 2.5 12 2.5C6.47715 2.5 2 6.97715 2 12.5C2 18.0228 6.47715 22.5 12 22.5Z" fill="#8D96AC" />
                            <path d="M16.03 11.9699L13.03 8.96994C12.74 8.67994 12.26 8.67994 11.97 8.96994C11.68 9.25994 11.68 9.73994 11.97 10.0299L13.69 11.7499H8.5C8.09 11.7499 7.75 12.0899 7.75 12.4999C7.75 12.9099 8.09 13.2499 8.5 13.2499H13.69L11.97 14.9699C11.68 15.2599 11.68 15.7399 11.97 16.0299C12.12 16.1799 12.31 16.2499 12.5 16.2499C12.69 16.2499 12.88 16.1799 13.03 16.0299L16.03 13.0299C16.32 12.7399 16.32 12.2599 16.03 11.9699Z" fill="#8D96AC" />
                        </svg>
                        <span class="ms-3 text-[#141A14]">Log out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-0 sm:ml-64">
        <div class="top-navigation p-4 border-b-1 pr-8 flex justify-between items-center">
            <?php
  

            // Access session variables
            $userName = $_SESSION['user_name'] ?? '';
            $userEmail = $_SESSION['user_email'] ?? '';
            ?>

            <div class="flex flex-col">
                <h1 class="text-lg font-semibold tracking-tight">Welcome, <?php echo htmlspecialchars($userName); ?> 👋🏿</h1>
                <p id="currentDate" class="text-sm text-[#141a14a2]"></p>

                <script>
                    // Get the current date
                    var currentDate = new Date();
                    var options = {
                        weekday: 'long',
                        month: 'long',
                        day: 'numeric'
                    };
                    var formattedDate = currentDate.toLocaleDateString('en-US', options);
                    document.getElementById('currentDate').innerText = formattedDate;
                </script>
            </div>

            <div class="flex items-center space-x-2">
                <img src="../src/assets/Number=7.jpg" alt="" class="rounded-full w-10">
                <div class="md:flex flex-col hidden">
                    <h1 class="text-[#141A14] text-sm font-semibold"><?php echo htmlspecialchars($userName); ?></h1>
                    <p class="text-xs text-[#141a14a2]"><?php echo htmlspecialchars($userEmail); ?></p>
                </div>
            </div>

        </div>
        <hr>
        <?php echo isset($content) ? $content : ''; ?>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>