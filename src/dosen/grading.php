<?php
session_start();

include '../../database/config.php';
include '../../auth/aksesdosen.php';
include '../../auth/who.php';


$dosenID = $_SESSION['UserID'];


if (!isset($_GET['TugasID']) || empty($_GET['TugasID'])) {
    echo "TugasID tidak ditemukan.";
    exit();
}

$tugasID = $_GET['TugasID'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['jawaban_id']) && isset($_POST['nilai'])) {
    $jawabanID = $_POST['jawaban_id'];
    $nilai = $_POST['nilai'];
    $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : '';

    $sql_insert = "INSERT INTO Nilai (JawabanID, Nilai, Feedback) VALUES (?, ?, ?)";
    if ($stmt_insert = $conn->prepare($sql_insert)) {
        $stmt_insert->bind_param("iis", $jawabanID, $nilai, $feedback);
        if ($stmt_insert->execute()) {
            $message = "Nilai berhasil disimpan.";
        } else {
            $message = "Gagal menyimpan nilai.";
        }
        $stmt_insert->close();
    } else {
        $message = "Gagal mempersiapkan statement SQL.";
    }
}


$sql = "SELECT jt.JawabanID, jt.MahasiswaID, jt.FilePath, u.Name
        FROM JawabanTugas jt
        INNER JOIN User u ON jt.MahasiswaID = u.UserID
        LEFT JOIN Nilai n ON jt.JawabanID = n.JawabanID
        WHERE jt.TugasID = ? AND n.JawabanID IS NULL";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $tugasID);
    $stmt->execute();
    $result = $stmt->get_result();
    $jawabanTugas = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Gagal mempersiapkan statement SQL.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/css/home.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
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
            <a href="">
                <div class="w-full flex gap-3 items-center p-4 rounded-[14px] bg-[#0A090B] mt-[30px]">
                    <div>
                        <img src="../../assets/img/icons/crown-round-bg.svg" alt="icon">
                    </div>
                    <div class="flex flex-col gap-[2px]">
                        <p class="font-semibold text-white">Get Pro</p>
                        <p class="text-sm leading-[21px] text-[#A0A0A0]">Unlock features</p>
                    </div>
                </div>
            </a>
        </div>
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
                <form
                    class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
                    <input type="text"
                        class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                        placeholder="Search by report, student, etc" name="search">
                    <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                        <img src="../../assets/img/icons/search.svg" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href=""
                            class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="../../assets/img/icons/receipt-text.svg" alt="icon">
                        </a>
                        <a href=""
                            class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
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
                    <a href="manage.php" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Atur Kelas</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Nilai Mahasiswa</a>
                </div>
            </div>
            <div>
                <?php if (empty($jawabanTugas)): ?>
                    <p>Tidak ada jawaban tugas yang perlu dinilai.</p>
                <?php else: ?>
                    <?php foreach ($jawabanTugas as $jawaban): ?>
                        <div class="student-btn" data-jawaban-id="<?php echo $jawaban['JawabanID']; ?>" data-file-path="<?php echo $jawaban['FilePath']; ?>">
                            <?php echo htmlspecialchars($jawaban['Name']); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div id="tugas-details" style="display:none;">
                <p><a id="file-link" href="" target="_blank">Lihat Tugas</a></p>
                <form method="POST" action="grading.php?TugasID=<?php echo $tugasID; ?>">
                    <input type="hidden" name="jawaban_id" id="jawaban-id" value="">
                    <label for="nilai">Nilai:</label>
                    <input type="number" name="nilai" id="nilai" min="0" max="100" step="0.01" required>
                    <label for="feedback">Feedback:</label>
                    <textarea name="feedback" id="feedback"></textarea>
                    <button type="submit">Simpan Nilai</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.student-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.student-btn').forEach(btn => btn.classList.remove('selected'));
                button.classList.add('selected');
                document.getElementById('tugas-details').style.display = 'block';
                document.getElementById('file-link').href = '../../storages/' + button.getAttribute('data-file-path');
                document.getElementById('jawaban-id').value = button.getAttribute('data-jawaban-id');
            });
        });
    </script>
</body>
</html>
