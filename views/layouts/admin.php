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
    <link rel="icon" type="image/svg" href="asset/assets/favicon.svg" />
    <link rel="stylesheet" href="asset/input.css">
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
        <svg width="213" height="40" viewBox="0 0 213 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M32.6571 16.5412L22.7523 19.3715C22.503 19.4428 22.2768 19.5784 22.0965 19.7648C21.9162 19.9511 21.7881 20.1816 21.7251 20.4331L20.9615 23.4925C20.8984 23.744 20.7703 23.9745 20.59 24.1609C20.4097 24.3472 20.1836 24.4829 19.9343 24.5542L10.4408 27.2589C10.1912 27.3304 9.96487 27.4664 9.78455 27.6532C9.60423 27.84 9.4763 28.071 9.41364 28.323L8.12535 33.4442C8.11497 33.4862 8.11585 33.5302 8.12788 33.5717C8.13992 33.6133 8.16269 33.6509 8.1939 33.6809C8.22512 33.7109 8.26367 33.7321 8.30569 33.7424C8.34771 33.7527 8.39171 33.7518 8.43326 33.7397L18.3356 30.9094C18.5849 30.8381 18.8111 30.7025 18.9914 30.5161C19.1717 30.3298 19.2998 30.0993 19.3628 29.8478L20.1264 26.7958C20.1895 26.5443 20.3176 26.3137 20.4979 26.1274C20.6782 25.941 20.9043 25.8054 21.1536 25.7341L30.6471 23.0245C30.8967 22.953 31.123 22.817 31.3033 22.6302C31.4837 22.4434 31.6116 22.2123 31.6743 21.9604L32.9625 16.8417C32.9738 16.7996 32.9737 16.7553 32.9622 16.7133C32.9508 16.6713 32.9284 16.633 32.8973 16.6025C32.8663 16.5719 32.8277 16.5502 32.7855 16.5394C32.7433 16.5286 32.699 16.5292 32.6571 16.5412Z" fill="url(#paint0_linear_222_14)" />
            <path d="M32.6571 6.24995L22.7523 9.0901C22.503 9.16141 22.2768 9.29705 22.0965 9.4834C21.9162 9.66975 21.7881 9.90026 21.7251 10.1518L20.9615 13.2038C20.8984 13.4553 20.7703 13.6858 20.59 13.8721C20.4097 14.0585 20.1836 14.1941 19.9343 14.2654L10.4408 16.9775C10.1912 17.049 9.96487 17.185 9.78455 17.3718C9.60423 17.5587 9.4763 17.7897 9.41364 18.0416L8.12535 23.1628C8.11497 23.2048 8.11585 23.2488 8.12788 23.2904C8.13992 23.3319 8.16269 23.3696 8.1939 23.3995C8.22512 23.4295 8.26367 23.4507 8.30569 23.4611C8.34771 23.4714 8.39171 23.4705 8.43326 23.4584L18.3356 20.6281C18.5849 20.5568 18.8111 20.4211 18.9914 20.2348C19.1717 20.0484 19.2998 19.8179 19.3628 19.5664L20.1264 16.5144C20.1895 16.2629 20.3176 16.0324 20.4979 15.846C20.6782 15.6597 20.9043 15.524 21.1536 15.4527L30.6471 12.7431C30.8992 12.6719 31.1279 12.5349 31.3097 12.3462C31.4915 12.1575 31.6199 11.9238 31.6816 11.6692L32.9625 6.548C32.9733 6.50609 32.9727 6.46209 32.961 6.42045C32.9493 6.3788 32.9269 6.34096 32.8959 6.31075C32.865 6.28054 32.8266 6.25901 32.7847 6.24834C32.7427 6.23766 32.6987 6.23822 32.6571 6.24995Z" fill="url(#paint1_linear_222_14)" />
            <path d="M47.904 30V10.12H53.448L58.768 25.352H58.796L64.088 10.12H69.632V30H65.796V15.412H65.74L60.56 30H56.976L51.796 15.412H51.74V30H47.904ZM76.1871 30.336C73.4711 30.336 71.5671 28.768 71.5671 26.248C71.5671 23.7 73.5551 21.936 77.2791 21.544L79.5471 21.292C80.2191 21.236 80.7231 20.788 80.7231 20.004C80.7231 18.8 79.6591 18.044 78.2311 18.044C76.4951 18.044 75.3751 19.36 75.3191 20.872L71.9591 20.088C72.0711 17.372 74.5631 15.244 78.2591 15.244C81.9551 15.244 84.2791 17.372 84.2791 20.564V30H81.0311L80.6391 28.012H80.6111C79.7151 29.496 78.1471 30.336 76.1871 30.336ZM77.5311 27.564C79.3231 27.564 80.6391 26.22 80.6391 24.232V23.504L78.1191 23.784C76.1311 24.008 75.2351 24.82 75.2351 25.884C75.2351 26.948 76.1871 27.564 77.5311 27.564ZM92.3507 30.448C89.3827 30.448 87.6467 28.684 87.6467 25.884V18.52H85.1827V15.72H87.6467V11.856L91.2867 11.044V15.72H96.1307V18.52H91.2867V25.24C91.2867 26.612 91.9307 27.424 93.0227 27.424C94.0587 27.424 94.8427 26.808 95.1787 25.296L96.9427 27.228C96.3827 29.272 94.6467 30.448 92.3507 30.448ZM105.261 15.3C107.613 15.3 109.069 17.064 109.181 20.116L106.101 20.984C106.017 19.164 105.317 18.156 104.197 18.156C102.741 18.156 101.873 19.696 101.873 22.328V30H98.2049V15.72H101.173L101.621 18.1H101.649C102.293 16.336 103.637 15.3 105.261 15.3ZM112.833 13.508C111.489 13.508 110.565 12.612 110.565 11.268C110.565 9.952 111.489 9.056 112.833 9.056C114.205 9.056 115.129 9.952 115.129 11.268C115.129 12.612 114.205 13.508 112.833 13.508ZM110.985 30V15.72H114.653V30H110.985ZM123.637 30.476C119.409 30.476 116.693 27.508 116.721 22.86C116.721 18.212 119.325 15.244 123.273 15.244C126.465 15.244 128.789 17.204 129.405 20.34L126.017 21.152C125.653 19.304 124.589 18.268 123.301 18.268C121.537 18.268 120.361 20.004 120.361 22.86C120.361 25.716 121.705 27.452 123.665 27.452C125.345 27.452 126.577 26.164 126.885 24.008L130.273 24.624C129.769 28.18 127.193 30.476 123.637 30.476ZM137.7 30V10.12H142.852L149.964 25.016H150.02V10.12H153.884V30H148.76L141.62 15.132H141.564V30H137.7ZM163.147 30.476C158.863 30.476 156.091 27.48 156.091 22.832C156.091 18.212 158.863 15.244 163.147 15.244C167.431 15.244 170.203 18.212 170.203 22.832C170.203 27.48 167.431 30.476 163.147 30.476ZM163.147 27.34C165.219 27.34 166.563 25.604 166.563 22.832C166.563 20.088 165.219 18.38 163.147 18.38C161.047 18.38 159.731 20.088 159.731 22.832C159.731 25.604 161.047 27.34 163.147 27.34Z" fill="#0D0D0D" />
            <rect x="178" y="11" width="35" height="18" rx="9" fill="#0D0D0D" />
            <path d="M184.176 22L186.016 16.32H187.464L189.312 22H188.12L187.76 20.808H185.72L185.36 22H184.176ZM185.928 19.928H187.552L186.76 17.304H186.744L185.928 19.928ZM191.009 22.12C190.009 22.12 189.353 21.28 189.353 19.96C189.353 18.632 190.009 17.8 191.009 17.8C191.553 17.8 191.985 18.064 192.233 18.528H192.241V16.08H193.289V22H192.393L192.273 21.368H192.265C192.025 21.856 191.561 22.12 191.009 22.12ZM191.337 21.2C191.913 21.2 192.281 20.712 192.281 19.96C192.281 19.208 191.913 18.72 191.337 18.72C190.769 18.72 190.393 19.208 190.393 19.96C190.393 20.72 190.769 21.2 191.337 21.2ZM193.96 22V17.92H194.816L194.944 18.576H194.952C195.176 18.088 195.648 17.8 196.216 17.8C196.8 17.8 197.216 18.088 197.4 18.6H197.408C197.696 18.072 198.192 17.8 198.744 17.8C199.528 17.8 199.992 18.32 199.992 19.2V22H198.944L198.952 19.352C198.952 18.944 198.712 18.696 198.304 18.696C197.8 18.696 197.504 19.08 197.504 19.672L197.496 22H196.456V19.352C196.456 18.944 196.216 18.696 195.808 18.696C195.304 18.696 195.008 19.08 195.008 19.672V22H193.96ZM201.21 17.288C200.826 17.288 200.562 17.032 200.562 16.648C200.562 16.272 200.826 16.016 201.21 16.016C201.602 16.016 201.866 16.272 201.866 16.648C201.866 17.032 201.602 17.288 201.21 17.288ZM200.682 22V17.92H201.73V22H200.682ZM204.761 17.808C205.521 17.808 205.985 18.296 205.985 19.128V22H204.945V19.328C204.945 18.912 204.713 18.664 204.337 18.664C203.833 18.664 203.505 19.016 203.505 19.576V22H202.457V17.92H203.337L203.473 18.536H203.481C203.737 18.072 204.193 17.808 204.761 17.808Z" fill="white" />
            <defs>
                <linearGradient id="paint0_linear_222_14" x1="20.5445" y1="16.5317" x2="20.5445" y2="33.7495" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#0D0D0D" />
                    <stop offset="1" stop-color="#0A0C08" />
                </linearGradient>
                <linearGradient id="paint1_linear_222_14" x1="20.5442" y1="6.24072" x2="20.5442" y2="23.4682" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#0D0D0D" />
                    <stop offset="1" stop-color="#0A0C08" />
                </linearGradient>
            </defs>
        </svg>
    </button>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto md:bg-[#f9fafc17] bg-[#FFFFFF] border border-l-1">
            <a href="#" class="flex items-center ps-2.5 mb-5">
                <img src="asset/assets/admin-logo.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
            </a>
            <hr class="mt-3 mb-5 opacity-50">
            <ul class="space-y-3 font-medium">
                <li>
                    <a href="<?php echo $appUrl . '/admindashboard'; ?>" class="flex items-center p-2 text-gray-900 rounded-md bg-[#0D0D0D] linear">
                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M17.1142 2.33337H15.3725C13.3742 2.33337 12.32 3.38754 12.32 5.38587V7.12754C12.32 9.12587 13.3742 10.18 15.3725 10.18H17.1142C19.1125 10.18 20.1667 9.12587 20.1667 7.12754V5.38587C20.1667 3.38754 19.1125 2.33337 17.1142 2.33337Z" fill="#fff" />
                            <path opacity="0.4" d="M6.63666 12.8108H4.895C2.8875 12.8108 1.83333 13.865 1.83333 15.8633V17.605C1.83333 19.6125 2.8875 20.6666 4.88583 20.6666H6.6275C8.62583 20.6666 9.68 19.6125 9.68 17.6141V15.8725C9.68917 13.865 8.635 12.8108 6.63666 12.8108Z" fill="#fff" />
                            <path d="M5.76583 10.1984C7.93769 10.1984 9.69833 8.43773 9.69833 6.26587C9.69833 4.09401 7.93769 2.33337 5.76583 2.33337C3.59397 2.33337 1.83333 4.09401 1.83333 6.26587C1.83333 8.43773 3.59397 10.1984 5.76583 10.1984Z" fill="#fff" />
                            <path d="M16.2342 20.6666C18.406 20.6666 20.1667 18.906 20.1667 16.7341C20.1667 14.5623 18.406 12.8016 16.2342 12.8016C14.0623 12.8016 12.3017 14.5623 12.3017 16.7341C12.3017 18.906 14.0623 20.6666 16.2342 20.6666Z" fill="#fff" />
                        </svg>
                        <span class="ms-3 text-white">Overview</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $appUrl . '/students'; ?>" class="flex items-center p-2 text-gray-900 rounded-md hover:bg-[#141a1409]">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 13.5C17.06 13.5 16.19 13.83 15.5 14.38C14.58 15.11 14 16.24 14 17.5C14 18.25 14.21 18.96 14.58 19.56C15.27 20.72 16.54 21.5 18 21.5C19.01 21.5 19.93 21.13 20.63 20.5C20.94 20.24 21.21 19.92 21.42 19.56C21.79 18.96 22 18.25 22 17.5C22 15.29 20.21 13.5 18 13.5ZM20.07 17.07L17.94 19.04C17.8 19.17 17.61 19.24 17.43 19.24C17.24 19.24 17.05 19.17 16.9 19.02L15.91 18.03C15.62 17.74 15.62 17.26 15.91 16.97C16.2 16.68 16.68 16.68 16.97 16.97L17.45 17.45L19.05 15.97C19.35 15.69 19.83 15.71 20.11 16.01C20.39 16.31 20.37 16.78 20.07 17.07Z" fill="#8D96AC" />
                            <path opacity="0.4" d="M21.09 22C21.09 22.28 20.87 22.5 20.59 22.5H3.41C3.13 22.5 2.91 22.28 2.91 22C2.91 17.86 6.99 14.5 12 14.5C13.03 14.5 14.03 14.64 14.95 14.91C14.36 15.61 14 16.52 14 17.5C14 18.25 14.21 18.96 14.58 19.56C14.78 19.9 15.04 20.21 15.34 20.47C16.04 21.11 16.97 21.5 18 21.5C19.12 21.5 20.13 21.04 20.85 20.3C21.01 20.84 21.09 21.41 21.09 22Z" fill="#8D96AC" />
                            <path d="M12 12.5C14.7614 12.5 17 10.2614 17 7.5C17 4.73858 14.7614 2.5 12 2.5C9.23858 2.5 7 4.73858 7 7.5C7 10.2614 9.23858 12.5 12 12.5Z" fill="#8D96AC" />
                        </svg>
                        <span class="ms-3 text-[#141A14]">Students</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $appUrl . '/manage-departments'; ?>" class="flex items-center p-2 text-gray-900 rounded-md hover:bg-[#141a1409]">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M2 13.3801V11.6201C2 10.5801 2.85 9.72006 3.9 9.72006C5.71 9.72006 6.45 8.44006 5.54 6.87006C5.02 5.97006 5.33 4.80006 6.24 4.28006L7.97 3.29006C8.76 2.82006 9.78 3.10006 10.25 3.89006L10.36 4.08006C11.26 5.65006 12.74 5.65006 13.65 4.08006L13.76 3.89006C14.23 3.10006 15.25 2.82006 16.04 3.29006L17.77 4.28006C18.68 4.80006 18.99 5.97006 18.47 6.87006C17.56 8.44006 18.3 9.72006 20.11 9.72006C21.15 9.72006 22.01 10.5701 22.01 11.6201V13.3801C22.01 14.4201 21.16 15.2801 20.11 15.2801C18.3 15.2801 17.56 16.5601 18.47 18.1301C18.99 19.0401 18.68 20.2001 17.77 20.7201L16.04 21.7101C15.25 22.1801 14.23 21.9001 13.76 21.1101L13.65 20.9201C12.75 19.3501 11.27 19.3501 10.36 20.9201L10.25 21.1101C9.78 21.9001 8.76 22.1801 7.97 21.7101L6.24 20.7201C5.33 20.2001 5.02 19.0301 5.54 18.1301C6.45 16.5601 5.71 15.2801 3.9 15.2801C2.85 15.2801 2 14.4201 2 13.3801Z" fill="#8D96AC" />
                            <path d="M12 15.75C13.7949 15.75 15.25 14.2949 15.25 12.5C15.25 10.7051 13.7949 9.25 12 9.25C10.2051 9.25 8.75 10.7051 8.75 12.5C8.75 14.2949 10.2051 15.75 12 15.75Z" fill="#8D96AC" />
                        </svg>
                        <span class="ms-3 text-[#141A14]">Manage Departments</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $appUrl . '/logout'; ?>" class="flex items-center p-2 text-gray-900 rounded-md hover:bg-[#141a1409]">
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
            <div class="flex flex-col">
                <h1 class="text-lg font-semibold tracking-tight">Welcome back, Admin👋🏿</h1>
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
                <img src="asset/assets/Number=73.png" alt="" class="rounded-full w-10">
                <div class="md:flex flex-col hidden">
                    <h1 class="text-[#141A14] text-sm font-semibold">Admin Panel</h1>
                    <p class="text-xs text-[#141a14a2]">admin@gmail.com</p>
                </div>
            </div>
        </div>
        <hr>
        <?php echo isset($content) ? $content : ''; ?>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>