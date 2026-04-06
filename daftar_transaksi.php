<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi - Agung Doni P</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Transaksi Peminjaman</h1>
        
        <?php
        
        $total_transaksi = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;
        
        // Loop pertama: Hitung statistik dulu supaya data di Card sinkron dengan Tabel
        for ($i = 1; $i <= 10; $i++) {
           
            if ($i % 2 == 0) continue;
        
            if ($i > 8) break;

            $status_cek = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
            
            $total_transaksi++;
            if ($status_cek == "Dipinjam") {
                $total_dipinjam++;
            } else {
                $total_dikembalikan++;
            }
        }
        ?>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center border-primary shadow-sm">
                    <div class="card-body">
                        <h6>Total Tampil</h6>
                        <h2 class="text-primary"><?php echo $total_transaksi; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center border-warning shadow-sm">
                    <div class="card-body">
                        <h6>Masih Dipinjam</h6>
                        <h2 class="text-warning"><?php echo $total_dipinjam; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center border-success shadow-sm">
                    <div class="card-body">
                        <h6>Sudah Kembali</h6>
                        <h2 class="text-success"><?php echo $total_dikembalikan; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Hari</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop kedua: Tampilkan data ke tabel
                    $no_tabel = 1;
                    for ($i = 1; $i <= 10; $i++) {
                        
                        if ($i % 2 == 0) continue; 
                        if ($i > 8) break;        
                    
                        $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                        $nama_peminjam = "Anggota " . $i;
                        $judul_buku = "Buku Teknologi Vol. " . $i;
                        
                        // Logika tanggal
                        $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                        $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                        
                        $tgl_diff = strtotime(date('Y-m-d')) - strtotime($tanggal_pinjam);
                        $hari_lewat = floor($tgl_diff / (60 * 60 * 24));
                        
                        $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
                        $warna_badge = ($status == "Dikembalikan") ? "success" : "warning";
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no_tabel++; ?></td>
                        <td><code><?php echo $id_transaksi; ?></code></td>
                        <td><?php echo $nama_peminjam; ?></td>
                        <td><?php echo $judul_buku; ?></td>
                        <td><?php echo $tanggal_pinjam; ?></td>
                        <td><?php echo $tanggal_kembali; ?></td>
                        <td><?php echo $hari_lewat; ?> hari</td>
                        <td>
                            <span class="badge bg-<?php echo $warna_badge; ?>">
                                <?php echo $status; ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>