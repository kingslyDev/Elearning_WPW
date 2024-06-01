<?php
session_start();

include '../../database/config.php';
include '../../auth/aksesmurid.php'; // Pastikan hanya mahasiswa yang dapat mengakses halaman ini
include '../../auth/who.php'; // Pastikan hanya mahasiswa yang dapat mengakses halaman ini

// Pastikan UserID ada dalam sesi dan rolenya adalah Mahasiswa
if (!isset($_SESSION['UserID']) || $_SESSION['Role'] !== 'Mahasiswa') {
    echo "Akses ditolak.";
    exit();
}

$mahasiswaID = $_SESSION['UserID'];

// Pastikan TugasID ada dalam URL
if (!isset($_GET['TugasID']) || empty($_GET['TugasID'])) {
    echo "TugasID tidak ditemukan.";
    exit();
}

$tugasID = $_GET['TugasID'];

// Ambil nilai mahasiswa berdasarkan TugasID
$sql = "SELECT Nilai, Feedback FROM Nilai WHERE JawabanID IN (SELECT JawabanID FROM JawabanTugas WHERE TugasID = ? AND MahasiswaID = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $tugasID, $mahasiswaID);
$stmt->execute();
$stmt->bind_result($nilai, $feedback);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Tugas</title>
    <link href="../../assets/css/home.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>

<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        <div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
            <div class="w-full flex flex-col gap-[30px]">
                <a href="manage.php" class="flex items-center justify-center">
                    <img src="../../assets/img/logo/logo.svg" alt="logo">
                </a>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3>
                    </li>
                    <li>
                        <a href="home.php" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/home-hashtag.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Beranda</p>
                        </a>
                    </li>
                    <li>
                        <a href="kelas.php" href="home.php" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/profile-2user.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Kelas</p>
                        </a>
                    </li>
                    <li>
                        <a href="nilai.php"
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/chart-2.svg" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Penilaian</p>
                        </a>
                    </li>
                    <li>
                        <a href="absen.php" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
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
                    <a href="home.php" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Beranda</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="kelas.php" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Kelas</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Detail Kelas</a>
                </div>
            </div>
            <div class="nilaicon">
                <h1>Nilai Tugas</h1>
                <p>Nilai Anda untuk Tugas ini:</p>
                <?php if (isset($nilai)): ?>
                    <p>Nilai: <?php echo $nilai; ?></p>
                    <p>Feedback: <?php echo $feedback; ?></p>
                <?php else: ?>
                    <p>Belum ada nilai untuk tugas ini.</p>
                <?php endif; ?>
                <a href="nilai.php">Kembali ke Dashboard</a>
            </div>
        </div>
    </section>
</body>

</html>

