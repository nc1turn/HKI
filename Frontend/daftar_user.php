<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/daftar_user.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
    <title>Daftar Permohonan User</title>
</head>
<body class="bg p-8 flex items-center justify-center min-h-screen">
    <div class="bg-gray-100 w-full max-w-5xl p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">DAFTAR PERMOHONAN USER</h1>
        <div class="w-full flex justify-end items-center mb-6">
            <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                <i class="fas fa-sign-out-alt mr-2"></i>
            </a>
        </div>

        <div class="flex items-center justify-between mb-4 gap-4">
            <input id="searchInput" class="p-2 rounded-lg border border-gray-300 w-1/2" placeholder="Cari Judul..." type="text" />
            <a href="input_awal.php">
                <button class="bg-green-700 text-white px-4 py-2 rounded flex items-center">
                    <i class="fas fa-plus mr-2"></i> Ajukan Permohonan
                </button>
            </a>
        </div>

        <div class="bg-white p-4 rounded-lg shadow flex justify-between items-start">
            <table class="border-separate border-spacing-y-2 w-full" id="permohonanUserTable">
                <thead>
                    <tr>
                        <th>JUDUL</th>
                        <th>SCAN KTP</th>
                        <th>CONTOH KARYA</th>
                        <th>SURAT PERNYATAAN</th>
                        <th>SURAT PENGALIHAN HAK CIPTA</th>
                        <th>BUKTI BAYAR</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody id="permohonanUserTable">
                    <tr><td colspan="7">Loading data...</td></tr>
                </tbody>
            </table>
        </div>

        <br />
        <div>
            <a href="menu_input.php">
                <button type="button" class="bg-teal-700 text-white px-4 py-2 rounded">SEBELUMNYA</button>
            </a>
        </div>
    </div>

    <script>
        // Hapus script fetchData inline, gunakan js/daftar_user.js saja
    </script>
</body>
</html>
