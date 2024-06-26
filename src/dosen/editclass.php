<?php

session_start();


include '../../auth/aksesdosen.php';
require_once '../../database/config.php';
include '../../auth/who.php';



if (isset($_GET['KelasID'])) {
    $kelasID = $_GET['KelasID'];


    $sql = "SELECT * FROM Kelas WHERE KelasID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kelasID);
    $stmt->execute();
    $result = $stmt->get_result();



}

$sql_tugas = "SELECT * FROM tugas WHERE KelasID = ?";
$stmt_tugas = $conn->prepare($sql_tugas);
$stmt_tugas->bind_param("i", $kelasID);
$stmt_tugas->execute();
$result_tugas = $stmt_tugas->get_result();




?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../assets/css/home.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        <div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
            <div class="w-full flex flex-col gap-[30px]">
                <a href="index.html" class="flex items-center justify-center">
                    <img src="../../assets/img/logo/logo.svg" alt="logo">
                </a>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/home-hashtag.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Overview</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/note-favorite.svg" alt="icon">
                            </div>
                            <p class="font-semibold text-white transition-all duration-300 hover:text-white">Courses</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/profile-2user.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Students</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/sms-tracking.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Messages</p>
                            <div class="notif w-5 h-5 flex shrink-0 rounded-full items-center justify-center bg-[#F6770B]">
                                <p class="font-bold text-[10px] leading-[15px] text-white">12</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/chart-2.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Analytics</p>
                        </a>
                    </li>
                </ul>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/3dcube.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Rewards</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/code.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">A.I Plugins</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/setting-2.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Settings</p>
                        </a>
                    </li>
                    <li>
                        <a href="signin.html" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/security-safe.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
                <form class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
                    <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Search by report, student, etc" name="search">
                    <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                        <img src="../../assets/img/icons/search.svg" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="../../assets/img/icons/receipt-text.svg" alt="icon">
                        </a>
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="../../assets/img/icons/notification.svg" alt="icon">
                        </a>
                    </div>
                    <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
                    <div class="flex gap-3 items-center">
                        <div class="flex flex-col text-right">
                            <p class="text-sm text-[#7F8190]">Howdy</p>
                            <p class="font-semibold">Fany Alqo</p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="../../assets/img/photos/default-photo.svg" alt="photo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-10 px-5 mt-5">
                <div class="breadcrumb flex items-center gap-[30px]">
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="index.html" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage Courses</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Course Details</a>
                </div>
            </div>
            <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                <div class="flex gap-6 items-center">
                    <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                        <img src="../../assets/img/thumbnail/Web-Development.png" class="w-full h-full object-contain" alt="icon">
                        <p class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap">Product Design</p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <h1 class="font-extrabold text-[30px] leading-[45px]">Digital Marketing 101</h1>
                        <div class="flex items-center gap-5">
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="../../assets/img/icons/calendar-add.svg" alt="icon">
                                </div>
                                <p class="font-semibold">22 August 2024</p>
                            </div>
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="../../assets/img/icons/profile-2user-outline.svg" alt="icon">
                                </div>
                                <p class="font-semibold">489,509 students</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <a href="#" id="more-button" class="toggle-button w-[46px] h-[46px] flex shrink-0 rounded-full items-center justify-center border border-[#EEEEEE]">
                        <img src="../../assets/img/icons/more.svg" alt="icon">
                    </a>
                    <div class="dropdown-menu absolute hidden right-0 top-[66px] w-[270px] flex flex-col gap-4 p-5 border border-[#EEEEEE] bg-white rounded-[18px] transition-all duration-300 shadow-[0_10px_16px_0_#0A090B0D]">
                        <a href="" class="flex gap-[10px] items-center">
                            <div class="w-5 h-5">
                                <img src="../../assets/img/icons/profile-2user-outline.svg" alt="icon">
                            </div>
                            <span class="font-semibold text-sm">Add Students</span>
                        </a>
                        <a href="" class="flex gap-[10px] items-center">
                            <div class="w-5 h-5">
                                <img src="../../assets/img/icons/note-favorite-outline.svg" alt="icon">
                            </div>
                            <span class="font-semibold text-sm">Edit Course Details</span>
                        </a>
                        <a href="" class="flex gap-[10px] items-center">
                            <div class="w-5 h-5">
                                <img src="../../assets/img/icons/crown-outline.svg" alt="icon">
                            </div>
                            <span class="font-semibold text-sm">Upload Certificate</span>
                        </a>
                        <a href="" class="flex gap-[10px] items-center text-[#FD445E]">
                            <div class="w-5 h-5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5 4.98332C14.725 4.70832 11.9333 4.56665 9.15 4.56665C7.5 4.56665 5.85 4.64998 4.2 4.81665L2.5 4.98332" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.08325 4.14163L7.26659 3.04996C7.39992 2.25829 7.49992 1.66663 8.90825 1.66663H11.0916C12.4999 1.66663 12.6083 2.29163 12.7333 3.05829L12.9166 4.14163" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.7084 7.6167L15.1667 16.0084C15.0751 17.3167 15.0001 18.3334 12.6751 18.3334H7.32508C5.00008 18.3334 4.92508 17.3167 4.83341 16.0084L4.29175 7.6167" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.6084 13.75H11.3834" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.91675 10.4166H12.0834" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-sm">Delete Course</span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="course-test" class="mx-[70px] w-[870px] mt-[30px]">
                <h2 class="font-bold text-2xl">Course Tests</h2>
                <div class="flex flex-col gap-[30px] mt-2">
                    <a href="add-question.html" class="w-full h-[92px] flex items-center justify-center p-4 border-dashed border-2 border-[#0A090B] rounded-[20px]">
                        <div class="flex items-center gap-5">
                            <div>
                                <img src="../../assets/img/icons/note-add.svg" alt="icon">
                            </div>
                            <p class="font-bold text-xl">New Question</p>
                        </div>
                    </a>
                    <div class="question-card w-full flex items-center justify-between p-4 border border-[#EEEEEE] rounded-[20px]">
                        <div class="flex flex-col gap-[6px]">
                            <p class="text-[#7F8190]">Question</p>
                            <p class="font-bold text-xl">Why do we need to do marketing?</p>
                        </div>
                        <div class="flex items-center gap-[14px]">
                            <a href="#" class="bg-[#0A090B] p-[14px_30px] rounded-full text-white font-semibold">Edit</a>
                            <form action="">
                                <button class="w-[52px] h-[52px] flex shrink-0 items-center justify-center rounded-full bg-[#FD445E]">
                                    <img src="../../assets/img/icons/trash.svg" alt="icon">
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="question-card w-full flex items-center justify-between p-4 border border-[#EEEEEE] rounded-[20px]">
                        <div class="flex flex-col gap-[6px]">
                            <p class="text-[#7F8190]">Question</p>
                            <p class="font-bold text-xl">Why do we need to do marketing?</p>
                        </div>
                        <div class="flex items-center gap-[14px]">
                            <a href="#" class="bg-[#0A090B] p-[14px_30px] rounded-full text-white font-semibold">Edit</a>
                            <form action="">
                                <button class="w-[52px] h-[52px] flex shrink-0 items-center justify-center rounded-full bg-[#FD445E]">
                                    <img src="../../assets/img/icons/trash.svg" alt="icon">
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="question-card w-full flex items-center justify-between p-4 border border-[#EEEEEE] rounded-[20px]">
                        <div class="flex flex-col gap-[6px]">
                            <p class="text-[#7F8190]">Question</p>
                            <p class="font-bold text-xl">Why do we need to do marketing?</p>
                        </div>
                        <div class="flex items-center gap-[14px]">
                            <a href="#" class="bg-[#0A090B] p-[14px_30px] rounded-full text-white font-semibold">Edit</a>
                            <form action="">
                                <button class="w-[52px] h-[52px] flex shrink-0 items-center justify-center rounded-full bg-[#FD445E]">
                                    <img src="../../assets/img/icons/trash.svg" alt="icon">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuButton = document.getElementById('more-button');
            const dropdownMenu = document.querySelector('.dropdown-menu');
        
            menuButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
            });
        
            // Close the dropdown menu when clicking outside of it
            document.addEventListener('click', function (event) {
            const isClickInside = menuButton.contains(event.target) || dropdownMenu.contains(event.target);
            if (!isClickInside) {
                dropdownMenu.classList.add('hidden');
            }
            });
        });
    </script>
    
</body>
</html>



<?php

session_start();


include '../../auth/aksesdosen.php';
require_once '../../database/config.php';
include '../../auth/who.php';
require_once '../../database/config.php'; // Ubah sesuai dengan lokasi file konfigurasi database Anda

// Periksa apakah parameter GET KelasID telah diset
if (isset($_GET['KelasID'])) {
    $kelasID = $_GET['KelasID'];

    // Query untuk mendapatkan detail kelas berdasarkan KelasID
    $sql = "SELECT * FROM Kelas WHERE KelasID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kelasID);
    $stmt->execute();
    $result = $stmt->get_result();



}

$sql_tugas = "SELECT * FROM tugas WHERE KelasID = ?";
$stmt_tugas = $conn->prepare($sql_tugas);
$stmt_tugas->bind_param("i", $kelasID);
$stmt_tugas->execute();
$result_tugas = $stmt_tugas->get_result();




?>


<!doctype html>
<html>
    <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../assets/css/home.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
    <div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
            <div class="w-full flex flex-col gap-[30px]">
            <a href="index.html" class="flex items-center justify-center">
                    <img src="../../assets/img/logo/logo.svg" alt="logo">
                </a>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/home-hashtag.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Penilaian</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/profile-2user.svg" alt="icon">
                            </div>
                            <p class="font-semibold text-white transition-all duration-300 hover:text-white">Kelas</p>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/chart-2.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Penilaian</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/sms-tracking.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Absen</p>
                            <div class="notif w-5 h-5 flex shrink-0 rounded-full items-center justify-center bg-[#F6770B]">
                                <p class="font-bold text-[10px] leading-[15px] text-white">12</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3>
                    </li>
                    <li>
                        <a href="" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/setting-2.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Settings</p>
                        </a>
                    </li>
                    <li>
                        <a href="../../auth/logout.php" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/security-safe.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
                <form class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
                    <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Search by report, student, etc" name="search">
                    <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                        <img src="../../assets/img/icons/search.svg" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="../../assets/img/icons/receipt-text.svg" alt="icon">
                        </a>
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="../../assets/img/icons/notification.svg" alt="icon">
                        </a>
                    </div>
                    <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
                    <div class="flex gap-3 items-center">
                        <div class="flex flex-col text-right">
                            <p class="text-sm text-[#7F8190]">Howdy</p>
                            <p class="font-semibold"><?php echo $nama_user ?></p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="../../assets/img/photos/default-photo.svg" alt="photo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-10 px-5 mt-5">
                <div class="breadcrumb flex items-center gap-[30px]">
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="manage.php" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Atur Kelas</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Detail Kelas</a>
                </div>
            </div>
            <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                <?php while($row = $result->fetch_assoc()) :?>
                <div class="flex gap-6 items-center">
                    <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                        <img src="../../storages/<?php echo$row['Thumbnail'] ?>" class="w-full h-full object-contain" alt="icon">
                        <p class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap"><?php echo htmlspecialchars($row['Kategori'])?></p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <h1 class="font-extrabold text-[30px] leading-[45px]"><?php echo htmlspecialchars($row['NamaKelas'])?></h1>
                        <div class="flex items-center gap-5">
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="../../assets/img/icons/calendar-add.svg" alt="icon">
                                </div>
                                <p class="font-semibold"><?php echo date('d F Y', strtotime($row['created_at'])) ?></p>
                            </div>
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="../../assets/img/icons/profile-2user-outline.svg" alt="icon">
                                </div>
                                <p class="font-semibold"><?php echo htmlspecialchars($row['Deskripsi'])?> </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="relative">
                    <a href="#" id="more-button" class="toggle-button w-[46px] h-[46px] flex shrink-0 rounded-full items-center justify-center border border-[#EEEEEE]">
                        <img src="../../assets/img/icons/more.svg" alt="icon">
                    </a>
                    <div class="dropdown-menu absolute hidden right-0 top-[66px] w-[270px] flex flex-col gap-4 p-5 border border-[#EEEEEE] bg-white rounded-[18px] transition-all duration-300 shadow-[0_10px_16px_0_#0A090B0D]">
                        <a href="addstudent.php?KelasID=<?php echo $row['KelasID']?>" class="flex gap-[10px] items-center">
                            <div class="w-5 h-5">
                                <img src="../../assets/img/icons/profile-2user-outline.svg" alt="icon">
                            </div>
                            <span class="font-semibold text-sm">Add Students</span>
                        </a>
                        <a href="editclass.php" class="flex gap-[10px] items-center">
                            <div class="w-5 h-5">
                                <img src="../../assets/img/icons/note-favorite-outline.svg" alt="icon">
                            </div>
                            <span class="font-semibold text-sm">Edit Course Details</span>
                        </a>
                        <a href="deleteclass.php" class="flex gap-[10px] items-center text-[#FD445E]">
                            <div class="w-5 h-5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5 4.98332C14.725 4.70832 11.9333 4.56665 9.15 4.56665C7.5 4.56665 5.85 4.64998 4.2 4.81665L2.5 4.98332" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.08325 4.14163L7.26659 3.04996C7.39992 2.25829 7.49992 1.66663 8.90825 1.66663H11.0916C12.4999 1.66663 12.6083 2.29163 12.7333 3.05829L12.9166 4.14163" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.7084 7.6167L15.1667 16.0084C15.0751 17.3167 15.0001 18.3334 12.6751 18.3334H7.32508C5.00008 18.3334 4.92508 17.3167 4.83341 16.0084L4.29175 7.6167" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.6084 13.75H11.3834" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.91675 10.4166H12.0834" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-sm">Delete Course</span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="course-test" class="mx-[70px] w-[870px] mt-[30px]">
                <h2 class="font-bold text-2xl">Tambah Soal</h2>
                <div class="flex flex-col gap-[30px] mt-2">
                    <a href="addques.php?KelasID=<?php echo $row['KelasID']?>" class="w-full h-[92px] flex items-center justify-center p-4 border-dashed border-2 border-[#0A090B] rounded-[20px]">
                    <?php endwhile; ?>
                    <div class="flex items-center gap-5">
                            <div>
                                <img src="../../assets/img/icons/note-add.svg" alt="icon">
                            </div>
                            <p class="font-bold text-xl">Soal Baru</p>
                            </div>
                    </a>
                    <?php while($rowt = $result_tugas->fetch_assoc()) : ?>
                    <div class="question-card w-full flex items-center justify-between p-4 border border-[#EEEEEE] rounded-[20px]">
                        <div class="flex flex-col gap-[6px]">
                            <p class="text-[#7F8190]">Soal</p>
                            <p class="font-bold text-xl"><?php echo htmlspecialchars($rowt['NamaTugas'])?></p>
                        </div>
                    <div>
                        <div class="flex items-center gap-[14px]">
                                <button class="w-[52px] h-[52px] flex shrink-0 items-center justify-center rounded-full bg-[#FD445E]">
                                    <img src="../../assets/img/icons/trash.svg" alt="icon">
                                </button>
                                    <a href="open_pdf.php?TugasID=<?php echo($row['TugasID']) ?>" target="_blank">Lihat Kelas</a>          
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuButton = document.getElementById('more-button');
            const dropdownMenu = document.querySelector('.dropdown-menu');
        
            menuButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
            });
        
            // Close the dropdown menu when clicking outside of it
            document.addEventListener('click', function (event) {
            const isClickInside = menuButton.contains(event.target) || dropdownMenu.contains(event.target);
            if (!isClickInside) {
                dropdownMenu.classList.add('hidden');
            }
            });
        });

        
    </script>
    
</body>
</html>