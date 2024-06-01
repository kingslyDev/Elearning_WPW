<?php
// Lakukan koneksi ke database
require_once '../../database/config.php';

// Periksa apakah parameter KelasID telah diset
if (isset($_GET['TugasID'])) {
    // Ambil KelasID dari parameter URL
    $kelasID = $_GET['TugasID'];

    // Query untuk mengambil filepath berdasarkan TugasID
    $sql = "SELECT FilePath FROM tugas WHERE TugasID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kelasID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah ada baris hasil query
    if ($result->num_rows > 0) {
        // Ambil baris hasil query
        $row = $result->fetch_assoc();
        $filepath = $row['FilePath'];

        // Tentukan path lengkap ke file PDF
        $fullPath = "C:/xampp/htdocs/elearning/storages/" . $filepath;

        // Periksa apakah file PDF ada
        if (file_exists($fullPath)) {
            // Set header agar browser mengenali sebagai file PDF
            header('Content-type: application/pdf');
            // Outputkan file PDF
            readfile($fullPath);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan error
            echo "File PDF tidak ditemukan.";
        }
    } else {
        // Jika tidak ada baris hasil query, tampilkan pesan error
        echo "Tidak ada tugas yang ditemukan untuk KelasID yang diberikan.";
    }
} else {
    // Jika parameter KelasID tidak disertakan, tampilkan pesan error
    echo "TUGAS tidak ditemukan dalam parameter URL.";
}

// Tutup koneksi database
$stmt->close();
$conn->close();
?>
