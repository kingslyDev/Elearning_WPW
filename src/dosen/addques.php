<?php

session_start();

include '../../auth/aksesdosen.php';
require_once '../../database/config.php';
include '../../auth/who.php';

    if (isset($_GET['KelasID'])) {
        $kelasID = $_GET['KelasID'];

    $sql_kelas = "SELECT * FROM Kelas WHERE KelasID = ?";
    $stmt_kelas = $conn->prepare($sql_kelas);
    $stmt_kelas->bind_param("i", $kelasID);
    $stmt_kelas->execute();
    $result_kelas = $stmt_kelas->get_result();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $namaTugas = $_POST['NamaTugas'];
        $DueDate = $_POST['DueDate'];
    
        
        $targetDir = "C:/xampp/htdocs/elearning/storages/task/";
        $targetFile = $targetDir . basename($_FILES["FilePath"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
       
        if (file_exists($targetFile)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }
    
      
        if ($_FILES["FilePath"]["size"] > 500000000) {
            echo "Maaf, file terlalu besar.";
            $uploadOk = 0;
        }
    
        
        if($fileType != "docx" && $fileType != "pdf" && $fileType != "csv"
        && $fileType != "gif" ) {
            echo "Maaf, hanya file WORD, PDF, CSV yang diizinkan.";
            $uploadOk = 0;
        }
    
        
        if ($uploadOk == 0) {
            echo "Maaf, file tidak diunggah.";
       
        } else {
            if (move_uploaded_file($_FILES["FilePath"]["tmp_name"], $targetFile)) {
                
                $query_insert = "INSERT INTO Tugas (NamaTugas, DeskripsiTugas, DueDate, KelasID, DosenID, FilePath) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($query_insert);
                $deskripsiTugas = ""; 
                $dosenID = $_SESSION['UserID']; 
                $filePath = $targetFile;
                $stmt_insert->bind_param("sssiis", $namaTugas, $deskripsiTugas, $DueDate, $kelasID, $dosenID, $filePath);
                if ($stmt_insert->execute()) {
                    echo "Tugas berhasil ditambahkan.";
                } else {
                    echo "Maaf, terjadi kesalahan saat menambahkan tugas.";
                }
                $stmt_insert->close();
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        }
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
                        <a href="rekap.php" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
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
                            <p class="font-semibold">Pak <?php echo htmlspecialchars($nama_user)?></p>
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
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Atur Kelas</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Detail Kelas</a>
                </div>
            </div>
            <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                <?php while($rowk = $result_kelas->fetch_assoc()) :?>
                <div class="flex gap-6 items-center">
                    <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                        <img src="../../storages/<?php echo $rowk['Thumbnail'] ?>" class="w-full h-full object-contain" alt="icon">
                        <p class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap"><?php echo htmlspecialchars($rowk['Kategori'])?></p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <h1 class="font-extrabold text-[30px] leading-[45px]"><?php echo htmlspecialchars($rowk['NamaKelas'])?></h1>
                        <div class="flex items-center gap-5">
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="../../assets/img/icons/calendar-add.svg" alt="icon">
                                </div>
                                <p class="font-semibold"><?php echo date('d F Y', strtotime($rowk['created_at']))?></p>
                            </div>
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="../../assets/img/icons/profile-2user-outline.svg" alt="icon">
                                </div>
                                <p class="font-semibold"><?php echo htmlspecialchars($rowk['Deskripsi'])?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <form action="addques.php?KelasID=<?php echo $kelasID; ?>" class="mx-[70px] mt-[30px] flex flex-col gap-5" method="POST" enctype="multipart/form-data">
                <h2 class="font-bold text-2xl">Upload Soal</h2>
                <div class="flex flex-col gap-[10px]">
                    <p class="font-semibold">Soal</p>
                    <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                        <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                            <img src="../../assets/img/icons/note-text.svg" class="h-full w-full object-contain" alt="icon">
                        </div>
                        <input type="file" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Upload Soal" name="FilePath" id="FilePath">
                    </div>
                    <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                        <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                            <img src="../../assets/img/icons/note-text.svg" class="h-full w-full object-contain" alt="icon">
                        </div>
                        <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Judul Soal" id="NamaTugas" name="NamaTugas" require>
                    </div>
                    <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                        <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                            <img src="../../assets/img/icons/note-text.svg" class="h-full w-full object-contain" alt="icon">
                        </div>
                        <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Masukan Àrahan Singkat" id="DeskripsiTugas" name="DeskripsiTugas" required> 
                    </div>
                </div>
                <div class="flex flex-col gap-[10px]">
                    <p class="font-semibold">Deadline</p>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                            <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                                <img src="../../assets/img/icons/edit.svg" class="h-full w-full object-contain" alt="icon">
                            </div>
                            <input type="datetime-local" id="DueDate" name="DueDate" required>
                        </div>
                    </div>
                <button type="submit" class="w-[500px] h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Save Question</button>
            </form>
        </div>
    </section>
    
</body>
</html>

<?php
$stmt_kelas->close();
$conn->close();
?>