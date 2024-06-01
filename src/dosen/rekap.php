<?php
    session_start();

    include '../../database/config.php';
    include '../../auth/aksesdosen.php';

    $dosenID = $_SESSION['UserID'];


    $sql_kelas = "SELECT * FROM Kelas WHERE DosenID = ?";
    $stmt_kelas = $conn->prepare($sql_kelas);
    $stmt_kelas->bind_param("i", $dosenID);
    $stmt_kelas->execute();
    $result_kelas = $stmt_kelas->get_result();


    $nilai_per_kelas = array();

    while ($row_kelas = $result_kelas->fetch_assoc()) {
        $kelasID = $row_kelas['KelasID'];
        $namaKelas = $row_kelas['NamaKelas']; 
        
        $sql_nilai = "SELECT n.*, t.KelasID, u.Name AS NamaMahasiswa
                FROM Nilai n
                INNER JOIN JawabanTugas jt ON n.JawabanID = jt.JawabanID
                INNER JOIN Tugas t ON jt.TugasID = t.TugasID
                INNER JOIN User u ON jt.MahasiswaID = u.UserID
                WHERE t.KelasID = ?";
        $stmt_nilai = $conn->prepare($sql_nilai);
        $stmt_nilai->bind_param("i", $kelasID);
        $stmt_nilai->execute();
        $result_nilai = $stmt_nilai->get_result();

        
        $nilai_per_tugas = array();

        while ($row_nilai = $result_nilai->fetch_assoc()) {
            $nilai_per_tugas[] = $row_nilai;
        }

        $nilai_per_kelas[$kelasID] = array('NamaKelas' => $namaKelas, 'Nilai' => $nilai_per_tugas); // Ganti kelasID dengan NamaKelas
    }

    $stmt_kelas->close();
    $stmt_nilai->close();
    $conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai</title>
    <link href="../../assets/css/rekap.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Rekap Nilai</h1>
        <?php foreach ($nilai_per_kelas as $kelasID => $kelas): ?>
    <h2><?php echo $kelas['NamaKelas']; ?></h2>
    <table>
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Nilai</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kelas['Nilai'] as $nilai): ?>
                <tr>
                    <td><?php echo $nilai['NamaMahasiswa']; ?></td>
                    <td><?php echo $nilai['Nilai']; ?></td>
                    <td><?php echo $nilai['Feedback']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>

        <a href="manage.php">Kembali ke Dashboard</a>
    </div>
</body>

</html>
