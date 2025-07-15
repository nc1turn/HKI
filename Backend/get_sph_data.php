<?php
$host = "localhost";
$user = "root"; // Ganti dengan user database
$pass = ""; // Ganti dengan password database
$dbname = "hki";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(['error' => true, 'message' => 'Koneksi ke database gagal: ' . $conn->connect_error]));
}

// Ambil data surat terakhir
$sql = "SELECT * FROM detail_permohonan ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();

    // Ambil data dosen dan mahasiswa
    $query = "
        SELECT nama, alamat, 'Dosen' AS role FROM data_pribadi_dosen WHERE (id, dataid) IN (
            SELECT id, MAX(dataid) FROM data_pribadi_dosen GROUP BY id
        )
        UNION ALL
        SELECT nama, alamat, 'Mahasiswa' AS role FROM data_pribadi_mahasiswa WHERE (id, dataid) IN (
            SELECT id, MAX(dataid) FROM data_pribadi_mahasiswa GROUP BY id
        )";

    $result_pengusul = $conn->query($query);
    $pengusul = [];
    while ($row = $result_pengusul->fetch_assoc()) {
        $pengusul[] = $row;
    }

    echo json_encode([
        'success' => true,
        'data' => [
            'jenis_pendanaan' => $data['jenis_pendanaan'] ?? 'Tidak tersedia',
            'pengusul' => $pengusul
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
}

$conn->close();
?>