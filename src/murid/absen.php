<?php
session_start();

include '../../database/config.php';
include '../../auth/aksesmurid.php';
include '../../auth/who.php';



$mahasiswaID = $_SESSION['UserID'];
$message = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kelas_id'])) {
    $kelasID = $_POST['kelas_id'];
    $waktuAbsensi = date('Y-m-d H:i:s');

    
    $sql_check_open = "SELECT AbsensiTerbuka FROM Kelas WHERE KelasID = ?";
    if ($stmt_check_open = $conn->prepare($sql_check_open)) {
        $stmt_check_open->bind_param("i", $kelasID);
        $stmt_check_open->execute();
        $stmt_check_open->bind_result($absensiTerbuka);
        $stmt_check_open->fetch();
        $stmt_check_open->close();

        if ($absensiTerbuka == 1) {
            
            $sql_check = "SELECT * FROM Absensi WHERE MahasiswaID = ? AND KelasID = ?";
            if ($stmt_check = $conn->prepare($sql_check)) {
                $stmt_check->bind_param("ii", $mahasiswaID, $kelasID);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();
                if ($result_check->num_rows > 0) {
                    $message = "Anda sudah absen untuk kelas ini.";
                } else {
                   
                    $sql_insert = "INSERT INTO Absensi (KelasID, MahasiswaID, WaktuAbsensi) VALUES (?, ?, ?)";
                    if ($stmt_insert = $conn->prepare($sql_insert)) {
                        $stmt_insert->bind_param("iis", $kelasID, $mahasiswaID, $waktuAbsensi);
                        if ($stmt_insert->execute()) {
                            $message = "Absen berhasil dicatat.";
                        } else {
                            $message = "Gagal mencatat kehadiran.";
                        }
                        $stmt_insert->close();
                    } else {
                        $message = "Gagal mempersiapkan statement SQL.";
                    }
                }
                $stmt_check->close();
            } else {
                $message = "Gagal mempersiapkan statement SQL.";
            }
        } else {
            $message = "Absen belum dibuka.";
        }
    } else {
        $message = "Gagal mempersiapkan statement SQL.";
    }
}


$sql_kelas = "SELECT k.KelasID, k.NamaKelas FROM Kelas k
              INNER JOIN MahasiswaKelas mk ON k.KelasID = mk.KelasID
              WHERE mk.MahasiswaID = ?";
if ($stmt_kelas = $conn->prepare($sql_kelas)) {
    $stmt_kelas->bind_param("i", $mahasiswaID);
    $stmt_kelas->execute();
    $result_kelas = $stmt_kelas->get_result();
    $kelasList = $result_kelas->fetch_all(MYSQLI_ASSOC);
    $stmt_kelas->close();
} else {
    echo "Gagal mempersiapkan statement SQL.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen</title>
    <link href="../../assets/css/absen.css" rel="stylesheet"> <!-- Lokasi file CSS Anda -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        <!-- Sidebar and Navigation here -->

        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
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
                        
                            <p class="font-semibold"><?php echo htmlspecialchars($nama_user); ?></p>
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
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Absen</a>
                </div>
            </div>
            <div class="px-5 mt-5">
                <h1 class="text-[#2B82FE] text-2xl font-bold mb-2">Absen Kelas</h1>
                <p class="text-red-500"><?php echo $message; ?></p>
                <form method="POST" action="absen.php">
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700">Pilih Kelas:</label>
                    <select name="kelas_id" id="kelas_id" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <?php foreach ($kelasList as $kelas): ?>
                            <option value="<?php echo $kelas['KelasID']; ?>"><?php echo htmlspecialchars($kelas['NamaKelas']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#2B82FE] hover:bg-[#1E64D8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-3">Absen</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
