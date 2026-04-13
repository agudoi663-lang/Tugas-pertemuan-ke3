<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <?php
    require_once 'functions_anggota.php';
    
    // Data anggota 
    $anggota_list = [
        [
            "id" => "AGT-001",
            "nama" => "Budi Santoso",
            "email" => "budi@email.com",
            "telepon" => "081234567890",
            "alamat" => "Jakarta",
            "tanggal_daftar" => "2024-01-15",
            "status" => "Aktif",
            "total_pinjaman" => 5
        ],
        [
            "id" => "AGT-002",
            "nama" => "Siti Aminah",
            "email" => "siti.aminah@gmail.com",
            "telepon" => "081298765432",
            "alamat" => "Bandung",
            "tanggal_daftar" => "2024-02-10",
            "status" => "Aktif",
            "total_pinjaman" => 12
        ],
        [
            "id" => "AGT-003",
            "nama" => "Andi Wijaya",
            "email" => "andi@email", 
            "telepon" => "085612349876",
            "alamat" => "Surabaya",
            "tanggal_daftar" => "2023-11-05",
            "status" => "Non-Aktif",
            "total_pinjaman" => 2
        ],
        [
            "id" => "AGT-004",
            "nama" => "Rina Melati",
            "email" => "rina@yahoo.com",
            "telepon" => "081345678912",
            "alamat" => "Semarang",
            "tanggal_daftar" => "2024-03-20",
            "status" => "Aktif",
            "total_pinjaman" => 8
        ],
        [
            "id" => "AGT-005",
            "nama" => "Dedi Setiawan",
            "email" => "dedi_set@email.com",
            "telepon" => "087812345678",
            "alamat" => "Yogyakarta",
            "tanggal_daftar" => "2023-09-12",
            "status" => "Non-Aktif",
            "total_pinjaman" => 1
        ]
    ];

    // Manggil fungsi-fungsi dasar buat dashboard
    $total_agt = hitung_total_anggota($anggota_list);
    $total_aktif = hitung_anggota_aktif($anggota_list);
    $rata_pinjam = hitung_rata_rata_pinjaman($anggota_list);
    $anggota_teraktif = cari_anggota_teraktif($anggota_list);
    
    // Buat misahin data aktif sama non-aktif
    $list_aktif = filter_by_status($anggota_list, "Aktif");
    $list_nonaktif = filter_by_status($anggota_list, "Non-Aktif");

    // Logika buat BONUS: Search dan Sort
    $data_tabel = $anggota_list; // defaultnya nampilin semua
    $keyword_cari = "";

    if (isset($_GET['cari']) && $_GET['cari'] != "") {
        $keyword_cari = $_GET['cari'];
        $data_tabel = search_anggota_by_nama($data_tabel, $keyword_cari);
    }

    if (isset($_GET['sort']) && $_GET['sort'] == 'az') {
        $data_tabel = sort_anggota_by_nama($data_tabel);
    }
    ?>
    
    <div class="container mt-5 mb-5">
        <h1 class="mb-4"><i class="bi bi-people"></i> Sistem Anggota Perpustakaan</h1>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white h-100 shadow-sm">
                    <div class="card-body">
                        <h5>Total Anggota</h5>
                        <h3><?php echo $total_agt; ?> Orang</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white h-100 shadow-sm">
                    <div class="card-body">
                        <h5>Anggota Aktif</h5>
                        <h3><?php echo $total_aktif; ?> Orang</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white h-100 shadow-sm">
                    <div class="card-body">
                        <h5>Rata-rata Pinjaman</h5>
                        <h3><?php echo number_format($rata_pinjam, 1); ?> Buku</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="" method="GET" class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="col-form-label">Cari Anggota:</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="cari" class="form-control" placeholder="Ketik nama..." value="<?php echo htmlspecialchars($keyword_cari); ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="sistem_anggota.php" class="btn btn-outline-secondary">Reset</a>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="?sort=az" class="btn btn-warning"><i class="bi bi-sort-alpha-down"></i> Urutkan A-Z</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Daftar Anggota</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Tgl Daftar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($data_tabel) > 0): ?>
                                <?php foreach ($data_tabel as $agt): ?>
                                <tr>
                                    <td><?php echo $agt['id']; ?></td>
                                    <td><?php echo $agt['nama']; ?></td>
                                    <td>
                                        <?php echo $agt['email']; ?>
                                        <?php if(!validasi_email($agt['email'])): ?>
                                            <span class="badge bg-danger ms-1">Invalid</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo format_tanggal_indo($agt['tanggal_daftar']); ?></td>
                                    <td>
                                        <?php if($agt['status'] == 'Aktif'): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Non-Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Data anggota tidak ditemukan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-star-fill"></i> Anggota Teraktif</h5>
                    </div>
                    <div class="card-body text-center mt-3">
                        <?php if($anggota_teraktif != null): ?>
                            <h4><?php echo $anggota_teraktif['nama']; ?></h4>
                            <p class="text-muted mb-1"><?php echo $anggota_teraktif['id']; ?></p>
                            <h1 class="display-4 fw-bold text-success"><?php echo $anggota_teraktif['total_pinjaman']; ?></h1>
                            <p>Total Buku Dipinjam</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-success text-white">List Aktif</div>
                            <ul class="list-group list-group-flush">
                                <?php foreach($list_aktif as $aktif): ?>
                                    <li class="list-group-item"><?php echo $aktif['nama']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">List Non-Aktif</div>
                            <ul class="list-group list-group-flush">
                                <?php foreach($list_nonaktif as $nonaktif): ?>
                                    <li class="list-group-item"><?php echo $nonaktif['nama']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>