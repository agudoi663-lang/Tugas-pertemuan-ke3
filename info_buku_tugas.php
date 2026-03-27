<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Buku - Tugas Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <h1 class="mb-4 text-center">Informasi Buku Perpustakaan</h1>

        <div class="row">
        <?php
        // Data buku diubah menjadi array multidimensi agar mudah di-loop
        $kumpulan_buku = [
            [
                "judul" => "Pemrograman Web dengan PHP",
                "pengarang" => "Budi Raharjo",
                "penerbit" => "Informatika",
                "tahun_terbit" => 2023,
                "harga" => 85000,
                "stok" => 15,
                "isbn" => "978-602-1234-56-7",
                "kategori" => "Programming",
                "bahasa" => "Indonesia",
                "jumlah_halaman" => 350,
                "berat" => 450 
            ],
            [
                "judul" => "Database Systems: Design, Implementation",
                "pengarang" => "Carlos Coronel",
                "penerbit" => "Cengage",
                "tahun_terbit" => 2019,
                "harga" => 350000,
                "stok" => 5,
                "isbn" => "978-133-762-790-0",
                "kategori" => "Database",
                "bahasa" => "Inggris",
                "jumlah_halaman" => 790,
                "berat" => 1200
            ],
            [
                "judul" => "HTML & CSS: Design and Build Websites",
                "pengarang" => "Jon Duckett",
                "penerbit" => "Wiley",
                "tahun_terbit" => 2011,
                "harga" => 280000,
                "stok" => 8,
                "isbn" => "978-111-800-818-8",
                "kategori" => "Web Design",
                "bahasa" => "Inggris",
                "jumlah_halaman" => 490,
                "berat" => 850
            ],
            [
                "judul" => "Belajar Cepat Python",
                "pengarang" => "Abdul Kadir",
                "penerbit" => "Andi Publisher",
                "tahun_terbit" => 2022,
                "harga" => 95000,
                "stok" => 20,
                "isbn" => "978-979-29-5064-9",
                "kategori" => "Programming",
                "bahasa" => "Indonesia",
                "jumlah_halaman" => 410,
                "berat" => 500
            ]
        ];

        // Looping untuk menampilkan setiap buku
        foreach ($kumpulan_buku as $buku) {
            
           
            $badge_color = "bg-secondary"; 
            if ($buku["kategori"] == "Programming") {
                $badge_color = "bg-primary"; 
            } elseif ($buku["kategori"] == "Database") {
                $badge_color = "bg-success"; 
            } elseif ($buku["kategori"] == "Web Design") {
                $badge_color = "bg-warning text-dark"; 
            }
        ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo $buku["judul"]; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="badge <?php echo $badge_color; ?> fs-6">
                                <?php echo $buku["kategori"]; ?>
                            </span>
                        </div>

                        <table class="table table-sm table-borderless">
                            <tr>
                                <th width="150">Pengarang</th>
                                <td>: <?php echo $buku["pengarang"]; ?></td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td>: <?php echo $buku["penerbit"]; ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Terbit</th>
                                <td>: <?php echo $buku["tahun_terbit"]; ?></td>
                            </tr>
                            <tr>
                                <th>Bahasa</th>
                                <td>: <?php echo $buku["bahasa"]; ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Halaman</th>
                                <td>: <?php echo $buku["jumlah_halaman"]; ?> halaman</td>
                            </tr>
                            <tr>
                                <th>Berat</th>
                                <td>: <?php echo $buku["berat"]; ?> gram</td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>: <?php echo $buku["isbn"]; ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>: Rp <?php echo number_format($buku["harga"], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>: <?php echo $buku["stok"]; ?> buku</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php 
        } 
        ?>
        </div> </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>