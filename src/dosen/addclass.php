<?php
session_start();

require_once '../../database/config.php'; 
include '../../auth/aksesdosen.php';
include '../../auth/who.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kelas = $_POST['nama_kelas'];
    $kategori = $_POST['kategori'];
    $dosen_id = $_SESSION['UserID'];

    $target_dir = 'C:/xampp/htdocs/elearning/storages/cover/';
    $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadStatus = 1;

    $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadStatus = 0;
    }

    if ($_FILES["thumbnail"]["size"] > 500000) {
        echo "File Terlalu Besar";
        $uploadStatus = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Hanya Menerima FILE JPG,PNG,JPEG";
        $uploadStatus = 0;
    }

    if ($uploadStatus == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["thumbnail"]["name"]) . " has been uploaded.";
            $thumbnailPath = 'cover/' . basename($_FILES["thumbnail"]["name"]);

            $sql = "INSERT INTO Kelas (NamaKelas, Deskripsi, Thumbnail, Kategori, DosenID) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $nama_kelas, $deskripsi, $thumbnailPath, $kategori, $dosen_id);

            if ($stmt->execute()) {
                header("Location: manage.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $stmt->close();
    $conn->close();
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
                        <a href="grade.php"
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
                        <img src="../../assets/img//icons/search.svg" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="../../assets/img//icons/receipt-text.svg" alt="icon">
                        </a>
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="../../assets/img//icons/notification.svg" alt="icon">
                        </a>
                    </div>
                    <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
                    <div class="flex gap-3 items-center">
                        <div class="flex flex-col text-right">
                            <p class="text-sm text-[#7F8190]">Howdy</p>
                            <p class="font-semibold">Pak <?php echo $nama_user?></p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="../../assets/img//photos/default-photo.svg" alt="photo">
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
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Kelas Baru</a>
                </div>
            </div>
            <div class="header flex flex-col gap-1 px-5 mt-5">
                <h1 class="font-extrabold text-[30px] leading-[45px]">New Course</h1>
                <p class="text-[#7F8190]">Provide high quality for best students</p>
            </div>
            <form class="flex flex-col gap-[30px] w-[500px] mx-[70px] mt-10" method="POST" enctype="multipart/form-data">
        <div class="flex gap-5 items-center">
            <input type="file" name="thumbnail" id="thumbnail" class="peer hidden" onchange="previewFile()" required>
            <div class="relative w-[100px] h-[100px] rounded-full overflow-hidden peer-data-[empty=true]:border-[3px] peer-data-[empty=true]:border-dashed peer-data-[empty=true]:border-[#EEEEEE]">
                <div class="relative file-preview z-10 w-full h-full hidden">
                    <img src="" class="thumbnail-icon w-full h-full object-cover" alt="thumbnail">
                </div>
                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 text-center font-semibold text-sm text-[#7F8190]">Thumbnail<br>Course</span>
            </div>
            <button type="button" class="flex shrink-0 p-[8px_20px] h-fit items-center rounded-full bg-[#0A090B] font-semibold text-white" onclick="document.getElementById('thumbnail').click()">
                Add Thumbnail
            </button>
        </div>
        <div class="flex flex-col gap-[10px]">
            <label for="nama_kelas" class="font-semibold">Nama Kelas</label>
            <input type="text" id="nama_kelas" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]" placeholder="Tulis nama kelas" name="nama_kelas" required>
        </div>
        <div class="flex flex-col gap-[10px]">
            <label for="nama_kelas" class="font-semibold">Dosen</label>
            <input type="text" id="deksripsi" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]" placeholder="Tulis nama dosen pengajar" name="deksripsi" required>
        </div>
        <div class="group/category flex flex-col gap-[10px]">
            <label for="kategori" class="font-semibold">Kategori</label>
            <select id="kategori" class="pl-1 font-semibold focus:outline-none w-full text-[#0A090B] invalid:text-[#7F8190] invalid:font-normal appearance-none bg-[url('../../assets/img//icons/arrow-down.svg')] bg-no-repeat bg-right" name="kategori" required>
                <option value="" disabled selected hidden>Pilih Kategori</option>
                <option value="teori" class="font-semibold">Teori</option>
                <option value="praktek" class="font-semibold">Praktek</option>
            </select>
        </div>
        <button type="submit" class="w-full h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Save Course</button>
    </form>

    <script>
        function previewFile() {
            const preview = document.querySelector('.thumbnail-icon');
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                // convert image file to base64 string
                preview.src = reader.result;
                document.querySelector('.file-preview').classList.remove('hidden');
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        function handleActiveAnchor(element) {
            event.preventDefault();

            const group = element.getAttribute('data-group');
            
            // Reset all elements' aria-checked to "false" within the same data-group
            const allElements = document.querySelectorAll(`[data-group="${group}"][aria-checked="true"]`);
            allElements.forEach(el => {
                el.setAttribute('aria-checked', 'false');
            });
            
            // Set the clicked element's aria-checked to "true"
            element.setAttribute('aria-checked', 'true');
        }
    </script>
    
</body>
</html>