document.addEventListener("DOMContentLoaded", () => {
    loadUserData(1);
  
    // Hapus
    document.addEventListener("click", function (e) {
      if (e.target.matches(".btn-hapus")) {
        let id = e.target.dataset.id;
        if (confirm("Yakin ingin hapus data ini?")) {
          fetch("../backend/hapus_permohonan.php", {
            method: "POST",
            body: new URLSearchParams({ id }),
          })
            .then((res) => res.json())
            .then(() => {
              alert("Data berhasil dihapus!");
              loadUserData(1);
            });
        }
      }
    });
  });
  
  function loadUserData(page) {
    fetch(`../Backend/get_permohonan.php?page=${page}`)
      .then((res) => res.json())
      .then((res) => {
        let data = res.data;
        let table = document.getElementById("permohonanUserTable");
        table.innerHTML = "";
  
        data.forEach((row) => {
          table.innerHTML += `
            <tr>
              <td>${row.judul}</td>
              <td><a href="../uploads/${row.file_contoh_karya}" target="_blank">Lihat</a></td>
              <td><a href="../uploads/${row.file_ktp}" target="_blank">Lihat</a></td>
              <td><a href="../uploads/${row.file_sp}" target="_blank">Lihat</a></td>
              <td><a href="../uploads/${row.file_sph}" target="_blank">Lihat</a></td>
              <td><a href="../uploads/${row.file_bukti_pembayaran}" target="_blank">Lihat</a></td>
              <td>
                <a href="edit_permohonan.php?id=${row.detail_id}" class="btn btn-warning btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm btn-hapus" data-id="${row.detail_id}">Hapus</button>
              </td>
            </tr>
          `;
        });
  
        // Pagination (optional, bisa diimprove)
        if (document.getElementById("paginationUser")) {
          document.getElementById("paginationUser").innerHTML = `
            <a href="#" onclick="loadUserData(${page - 1})" class="px-3 py-1 bg-gray-300 rounded">Sebelumnya</a>
            <a href="#" onclick="loadUserData(${page + 1})" class="px-3 py-1 bg-gray-300 rounded">Berikutnya</a>
          `;
        }
      });
  }
  