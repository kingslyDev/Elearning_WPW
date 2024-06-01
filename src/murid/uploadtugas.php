<?php
session_start();

include '../../database/config.php';
include '../../auth/aksesmurid.php';
include '../../auth/who.php';

$message = "";


if (!isset($_GET['TugasID']) || empty($_GET['TugasID'])) {
    echo "TugasID tidak ditemukan.";
    exit();
}

if(isset(($_GET['TugasID']))){
    $tugasID = $_GET['TugasID']; 
    $sql = "SELECT * FROM tugas WHERE TugasID = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $tugasID); 
    $stmt->execute(); 
    $result_tugas = $stmt->get_result(); }



$tugasID = $_GET['TugasID'];



if (!isset($_SESSION['UserID']) || empty($_SESSION['UserID'])) {
    echo "MahasiswaID tidak ditemukan dalam sesi atau belum diatur.";
    exit();
}

$mahasiswaID = $_SESSION['UserID'];



$sql_check = "SELECT * FROM JawabanTugas WHERE TugasID = ? AND MahasiswaID = ?";
if ($stmt_check = $conn->prepare($sql_check)) {
    $stmt_check->bind_param("ii", $tugasID, $mahasiswaID);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
       
        echo "Anda sudah mengumpulkan tugas ini.";
        exit();
    }
    $stmt_check->close();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES['FilePath']['tmp_name']) && is_uploaded_file($_FILES['FilePath']['tmp_name'])) {
        $target_dir = 'C:/xampp/htdocs/elearning/storages/task/jawaban/';
        $target_file = $target_dir . basename($_FILES['FilePath']['name']);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $uploadStatus = 1;

       
        if ($fileType != 'pdf') { 
            $message = "Hanya file PDF yang diperbolehkan";
            $uploadStatus = 0;
        }

        if ($uploadStatus == 0) {
            $message = "File gagal diupload";
        } else {
           
            if (move_uploaded_file($_FILES['FilePath']['tmp_name'], $target_file)) {
               
                $filePath = 'task/jawaban/' . basename($_FILES['FilePath']['name']); 
                $sql = "INSERT INTO JawabanTugas (TugasID, MahasiswaID, FilePath, SubmissionDate) VALUES (?, ?, ?, NOW())"; 
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("iis", $tugasID, $mahasiswaID, $filePath);
                    if ($stmt->execute()) {
                        $message = "File berhasil diupload dan data berhasil disimpan";
                    } else {
                        $message = "Gagal menyimpan informasi file ke database";
                    }
                    $stmt->close();
                } else {
                    $message = "Gagal mempersiapkan statement SQL";
                }
            } else {
                $message = "File gagal diupload";
            }
        }
    } else {
        $message = "File tidak ditemukan atau tidak dapat diakses";
    }
}

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
                        <a href="kelas.php" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="../../assets/img/icons/profile-2user.svg" alt="icon">
                            </div>
                            <p class="font-semibold text-white transition-all duration-300 hover:text-white">Kelas</p>
                        </a>
                    </li>
                    <li>
                        <a href="nilai.php"
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
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
                            <p class="font-semibold"><?php echo $nama_user?></p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="../../assets/img/photos/default-photo.svg" alt="photo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-10 px-5 mt-5">
                <div class="breadcrumb flex items-center gap-[30px]">
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Beranda</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="kelas.php" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Kelas</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Dalam Tugas</a>
                </div>
            </div>
            <div id="course-test" class="mx-[70px] w-[870px] mt-[30px]">
            <?php while($row = $result_tugas->fetch_assoc()): ?>
                <h1 class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Kumpulkan Sebelum : <?php echo date('d F Y', strtotime($row['DueDate']))?> </h1>
                <div class="flex flex-col gap-[30px] mt-2">
                    <form  method="POST" enctype="multipart/form-data" >
                    <button type="submit" class="w-full h-[92px] flex items-center justify-center p-4 border-dashed border-2 border-[#0A090B] rounded-[20px]">
                        <div class="flex items-center gap-5">
                            <div>
                            
                            <input type="file" name="FilePath">
                            </div>                            
                            <p class="font-bold text-xl">Kumpulkan Tugas</p>
                        </div>
                    </button>
                </div>
            </form>
            </div>
            <div class="Porto">
            <iframe
            class="aspect-w-16 aspect-h-9 rounded-2xl border border-black"
            src="../../storages/<?php echo $row['FilePath']?>"
            title="Portofolio Fathur"
            alt="Portofolio Fathur"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen=""
            style="width: 100%; height: 600px; margin: 0 auto; display: block"
            ></iframe>
            </div>
            <?php endwhile; ?>
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