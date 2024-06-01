<?php
session_start();


include '../../auth/aksesdosen.php';
require_once '../../database/config.php';
include '../../auth/who.php';


$sql = "SELECT * FROM Kelas WHERE DosenID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['UserID']);
$stmt->execute();
$result = $stmt->get_result();

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
                        <a href="../dosen/home.php" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/home-hashtag.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Beranda</p>
                        </a>
                    </li>
                    <li>
                        <a href="manage.php"
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                            <img src="../../assets/img/icons/profile-2user.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Kelas</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                            <img src="../../assets/img/icons/chart-2.svg" alt="icon">
                            </div>
                            <p class="font-semibold text-white transition-all duration-300 hover:text-white">Penilaian</p>
                        </a>
                    </li>
                    
                    <li>
                        <a href="absent.php" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/sms-tracking.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Rekap</p>
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
                            <p class="font-semibold">Pak <?php echo $nama_user; ?></p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="../../assets/img/photos/default-photo.svg" alt="photo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col px-5 mt-5">
                <div class="w-full flex justify-between items-center">
                    <div class="flex flex-col gap-1">
                        <p class="font-extrabold text-[30px] leading-[45px]">Penilaian</p>
                        <p class="text-[#7F8190]">Koreksi Tugas MahasiswaMu!</p>
                    </div>
                </div>
            </div>
            <div class="course-list-container flex flex-col px-5 mt-[30px] gap-[30px]">
                <div class="course-list-header flex flex-nowrap justify-between pb-4 pr-10 border-b border-[#EEEEEE]">
                    <div class="flex shrink-0 w-[300px]">
                        <p class="text-[#7F8190]">Kelas</p>
                    </div>
                    <div class="flex justify-center shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Dibuat Pada</p>
                    </div>
                    <div class="flex justify-center shrink-0 w-[170px]">
                        <p class="text-[#7F8190]">Kategori</p>
                    </div>
                    <div class="flex justify-center shrink-0 w-[120px]">
                        <p class="text-[#7F8190]">Penilaian</p>
                    </div>
                </div>
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="list-items flex flex-nowrap justify-between pr-10">
                    <div class="flex shrink-0 w-[300px]">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 flex shrink-0 overflow-hidden rounded-full">
                                <img src="../../storages/<?php echo $row['Thumbnail']; ?>" class="object-cover" alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <p class="font-bold text-lg"><?php echo htmlspecialchars($row['NamaKelas'])?></p>
                                <p class="text-[#7F8190]"><?php echo htmlspecialchars($row['Deskripsi'])?></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex shrink-0 w-[150px] items-center justify-center">
                        <p class="font-semibold"><?php echo date('d F Y', strtotime($row['created_at']))?></p>
                    </div>
                    <div class="flex shrink-0 w-[170px] items-center justify-center">
                        <p class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B]"><?php echo htmlspecialchars($row['Kategori'])?></p>
                    </div>
                    <div class="flex shrink-0 w-[120px] items-center">
                        <div class="relative h-[41px]">
                        <div class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]">
                    <button onclick="toggleMaxHeight(this)" class="flex items-center justify-between font-bold text-sm w-full">
                    <img src="../../assets/img/icons/arrow-down.svg" alt="icon">
                    </button>
                    <a href="gradeclass.php?KelasID=<?php echo $row['KelasID']; ?>" class="flex items-center justify-between font-bold text-sm w-full">Lihat Tugas</a>
                    </div>
                </div>
                </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div id="pagiantion" class="flex gap-4 items-center mt-[37px] px-5">
            </div>
           
        </div>
        
    </section>

    <script>
        function toggleMaxHeight(button) {
            const menuDropdown = button.parentElement;
            menuDropdown.classList.toggle('max-h-fit');
            menuDropdown.classList.toggle('shadow-[0_10px_16px_0_#0A090B0D]');
            menuDropdown.classList.toggle('z-10');
        }

        document.addEventListener('click', function(event) {
            const menuDropdowns = document.querySelectorAll('.menu-dropdown');
            const clickedInsideDropdown = Array.from(menuDropdowns).some(function(dropdown) {
                return dropdown.contains(event.target);
            });
            
            if (!clickedInsideDropdown) {
                menuDropdowns.forEach(function(dropdown) {
                    dropdown.classList.remove('max-h-fit');
                    dropdown.classList.remove('shadow-[0_10px_16px_0_#0A090B0D]');
                    dropdown.classList.remove('z-10');
                });
            }
        });
    </script>
</body>
</html>


<?php
$stmt->close();
$conn->close();
?>