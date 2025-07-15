<?php
session_start(); // Pastikan session dimulai

// Ambil data dari session jika tersedia
$input_awal = $_SESSION['input_awal'] ?? [
    'judul' => '',
    'jenis_permohonan' => '',
    'jenis_ciptaan' => '',
    'uraian_singkat' => '',
    'tanggal_pertama_kali_diumumkan' => '',
    'kota_pertama_kali_diumumkan' => '',
    'jenis_pendanaan' => '',
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Input Surat Permohonan Hak Cipta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/inputawal.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>
<body class="bg p-9 flex justify-center items-center min-h-screen">
    <div class="bg-gray-100 w-full max-w-7xl p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">INPUT SURAT PERMOHONAN HAK CIPTA</h1>

        <form action="../Backend/proses_input_awal.php" method="post">
            <!-- Form Detail Permohonan (lengkap seperti kode awal Anda) -->
            <div class="bg-green-700 text-white p-4 rounded-t-lg">
                <h2 class="font-semibold">Detail Permohonan</h2>
            </div>
            <div class="bg-white p-6 rounded-b-lg shadow-md mb-6">
                <div class="container">
                    <!-- Jenis Permohonan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="jenis_permohonan">Jenis Permohonan <span class="text-red-500">*</span></label>
                        </div>
                        <div class="col-8">
                            <select name="jenis_permohonan" class="w-full mt-1 p-2 border rounded">
                                <option value="">Pilih Jenis Permohonan</option>
                                <option value="UMK">UMK, Lembaga Pendidikan, Lembaga Litbang Pemerintah</option>
                                <option value="Umum">Umum</option>
                            </select>
                        </div>
                    </div>

                    <!-- Jenis Ciptaan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="jenis_ciptaan" class="block text-gray-700">Jenis Ciptaan <span class="text-red-500">*</span></label>
                        </div>
                        <div class="col-8">
                            <select name="jenis_ciptaan" id="jenis_ciptaan" class="w-full mt-1 p-2 border rounded">
                                <option value="">Pilih Jenis Ciptaan</option>
                                <option value="Karya Tulis">Karya Tulis</option>
                                <option value="Karya Seni">Karya Seni</option>
                                <option value="Komposisi Musik">Komposisi Musik</option>
                                <option value="Karya Audio Visual">Karya Audio Visual</option>
                                <option value="Karya Fotografi">Karya Fotografi</option>
                                <option value="Karya Drama & Koreografi">Karya Drama & Koreografi</option>
                                <option value="Karya Rekaman">Karya Rekaman</option>
                                <option value="Karya Lainnya">Karya Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sub-Jenis Ciptaan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="sub_jenis_ciptaan" class="block text-gray-700">Sub-Jenis Ciptaan</label>
                        </div>
                        <div class="col-8">
                            <select name="sub_jenis_ciptaan" id="sub_jenis_ciptaan" class="w-full mt-1 p-2 border rounded">
                                <option value="">Pilih Sub-Jenis Ciptaan</option>
                            </select>
                        </div>
                    </div>
                    <script src="../js/inputawal.js"></script>


                    <!-- Judul -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="judul" class="block text-gray-700">Judul <span class="text-red-500">*</span></label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="judul" class="w-full mt-1 p-2 border rounded" placeholder="Masukkan judul" />
                        </div>
                    </div>

                    <!-- Uraian Singkat Ciptaan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="uraian_singkat" class="block text-gray-700">Uraian Singkat Ciptaan <span class="text-red-500">*</span></label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="uraian_singkat" class="w-full mt-1 p-2 border rounded" placeholder="Masukkan uraian singkat ciptaan" />
                        </div>
                    </div>

                    <!-- Tanggal Pertama Kali Diumumkan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="tanggal_pertama_kali_diumumkan" class="block text-gray-700">Tanggal Pertama Kali Diumumkan <span class="text-red-500">*</span></label>
                        </div>
                        <div class="col-8">
                            <input type="date" name="tanggal_pertama_kali_diumumkan" class="w-full mt-1 p-2 border rounded" />
                        </div>
                    </div>

                    <!-- Negara Pertama Kali Diumumkan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="negara_pertama_kali_diumumkan" class="block text-gray-700">Negara Pertama Kali Diumumkan</label>
                        </div>
                        <div class="col-8">
                        <input type="text" name="negara_pertama_kali_diumumkan" class="w-full mt-1 p-2 border rounded" value="INDONESIA" readonly />
                        </div>
                    </div>

                    <!-- Kota Pertama Kali Diumumkan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="kota_pertama_kali_diumumkan" class="block text-gray-700">Kota Pertama Kali Diumumkan <span class="text-red-500">*</span></label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="kota_pertama_kali_diumumkan" class="w-full mt-1 p-2 border rounded" placeholder="Masukkan Kota" />
                        </div>
                    </div>

                    <!-- Jenis Pendanaan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="jenisHibah" class="block text-gray-700">Jenis Pendanaan <span class="text-red-500">*</span></label>
                        </div>
                        <div class="col-8">
                            <select id="jenisHibah" name="jenis_hibah" class="w-full mt-1 p-2 border rounded" onchange="showHibahOptions()">
                                <option value="">Pilih Jenis Pendanaan</option>
                                <option value="internal">Internal</option>
                                <option value="eksternal">Eksternal</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nama Pendanaan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="hibah" class="block text-gray-700 hidden" id="hibahLabel">Nama Pendanaan <span class="text-red-500">*</span></label>
                        </div>
                        <div class="col-8">
                            <select id="hibah" name="jenis_pendanaan" class="w-full mt-1 p-2 border rounded hidden">
                                <option value="">Pilih Hibah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tampilan Pendanaan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label id="pendanaanLabel" class="block text-gray-700 hidden">Pendanaan:</label>
                        </div>
                        <div class="col-8">
                            <span id="pendanaanValue" class="text-blue-600 font-bold hidden"></span>
                        </div>
                    </div>

                    <input type="hidden" id="pendanaanHidden" name="pendanaanHidden" />
                </div>
            </div>

            <!-- Data Pemegang Hak Cipta -->
            <div class="bg-green-700 text-white p-4 rounded-t-lg">
                <h2 class="font-semibold">Data Pemegang Hak Cipta</h2>
            </div>
            <div class="bg-white p-6 rounded-b-lg shadow-md mb-6">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">No. Telp</th>
                            <th class="border p-2">Kewarganegaraan</th>
                            <th class="border p-2">Alamat</th>
                            <th class="border p-2">Negara</th>
                            <th class="border p-2">Provinsi</th>
                            <th class="border p-2">Kota</th>
                            <th class="border p-2">Kecamatan</th>
                            <th class="border p-2">Kode Pos</th>
                            <th class="border p-2">Pemegang Hakcipta</th>
                        </tr>
                    </thead>
                    <tbody id="penciptaTableBody">
                        <tr><td colspan="12" class="border p-4 text-center">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between mt-4">
                <a href="daftar_user.php"><button type="button" class="bg-green-800 text-white px-4 py-2 rounded">SEBELUMNYA</button></a>
                <a href="input.php"><button type="button" class="bg-green-800 text-white px-4 py-2 rounded">SELANJUTNYA</button></a>
            </div>
        </form>
    </div>

    <script src="inputawal.js"></script>
</body>
</html>
