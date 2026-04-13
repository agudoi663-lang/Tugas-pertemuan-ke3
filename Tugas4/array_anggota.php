<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Perpustakaan - Agung Doni P</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h1 class="mb-4"><i class="bi bi-people"></i> Data Anggota Perpustakaan</h1>
        
        <?php
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
                "email" => "siti@email.com",
                "telepon" => "081298765432",
                "alamat" => "Bandung",
                "tanggal_daftar" => "2024-02-10",
                "status" => "Aktif",
                "total_pinjaman" => 14
            ],
            [
                "id" => "AGT-003",
                "nama" => "Andi Wijaya",
                "email" => "andi@email.com",
                "telepon" => "085612349876",
                "alamat" => "Surabaya",
                "tanggal_daftar" => "2023-11-05",
                "status" => "Non-Aktif",
                "total_pinjaman" => 2
            ],
            [
                "id" => "AGT-004",
                "nama" => "Rina Melati",
                "email" => "rina@email.com",
                "telepon" => "081345678912",
                "alamat" => "Semarang",
                "tanggal_daftar" => "2024-03-20",
                "status" => "Aktif",
                "total_pinjaman" => 8
            ],
            [
                "id" => "AGT-005",
                "nama" => "Dedi Setiawan",
                "email" => "dedi@email.com",
                "telepon" => "087812345678",
                "alamat" => "Yogyakarta",
                "tanggal_daftar" => "2023-09-12",
                "status" => "Non-Aktif",
                "total_pinjaman" => 1
            ]
        ];

        //  Proses Hitung-hitungan (Logika)
        $total_anggota = count($anggota_list);
        $jumlah_aktif = 0;
        $jumlah_nonaktif = 0;
        $total_semua_pinjaman = 0;
        
        $pinjaman_terbanyak = 0;
        $anggota_teraktif = "";

        // Array baru buat nyimpen hasil filter
        $data_aktif = [];
        $data_nonaktif = [];

        // Looping sekali jalan buat nyari semua statistik
        foreach ($anggota_list as $anggota) {
            // Pisahin berdasarkan status sekalian ngitung jumlahnya
            if ($anggota["status"] == "Aktif") {
                $jumlah_aktif++;
                $data_aktif[] = $anggota; 
            } else {
                $jumlah_nonaktif++;
                $data_nonaktif[] = $anggota;
            }

            $total_semua_pinjaman += $anggota["total_pinjaman"];

            if ($anggota["total_pinjaman"] > $pinjaman_terbanyak) {
                $pinjaman_terbanyak = $anggota["total_pinjaman"];
                $anggota_teraktif = $anggota["nama"];
            }
        }

        // Hitung persentase dan rata-rata
        $persen_aktif = ($jumlah_aktif / $total_anggota) * 100;
        $persen_nonaktif = ($jumlah_nonaktif / $total_anggota) * 100;
        $rata_pinjaman = $total_semua_pinjaman / $total_anggota;
        ?>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-title">Total Anggota</h6>
                        <h2><?php echo $total_anggota; ?> <small class="fs-6">Orang</small></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-title">Status Anggota</h6>
                        <p class="mb-0">Aktif: <strong><?php echo $persen_aktif; ?>%</strong></p>
                        <p class="mb-0">Non-Aktif: <strong><?php echo $persen_nonaktif; ?>%</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-title">Rata-rata Pinjaman</h6>
                        <h2><?php echo number_format($rata_pinjaman, 1); ?> <small class="fs-6">Buku/Org</small></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-title">Anggota Teraktif</h6>
                        <h4 class="mb-1"><?php echo $anggota_teraktif; ?></h4>
                        <small>(<?php echo $pinjaman_terbanyak; ?> Buku)</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Daftar Semua Anggota</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Tgl Daftar</th>
                                <th>Total Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($anggota_list as $agt): ?>
                            <tr>
                                <td><code><?php echo $agt["id"]; ?></code></td>
                                <td><strong><?php echo $agt["nama"]; ?></strong></td>
                                <td>
                                    <?php echo $agt["email"]; ?><br>
                                    <small class="text-muted"><?php echo $agt["telepon"]; ?></small>
                                </td>
                                <td><?php echo $agt["alamat"]; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($agt["tanggal_daftar"])); ?></td>
                                <td class="text-center"><?php echo $agt["total_pinjaman"]; ?></td>
                                <td>
                                    <?php if ($agt["status"] == "Aktif"): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Non-Aktif</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Daftar Anggota Aktif</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($data_aktif as $aktif): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $aktif["nama"]; ?>
                                <span class="badge bg-primary rounded-pill"><?php echo $aktif["total_pinjaman"]; ?> pinjaman</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Daftar Anggota Non-Aktif</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($data_nonaktif as $nonaktif): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $nonaktif["nama"]; ?>
                                <span class="badge bg-dark rounded-pill"><?php echo $nonaktif["total_pinjaman"]; ?> pinjaman</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>