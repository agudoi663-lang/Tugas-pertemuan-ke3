<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Status Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Status Peminjaman Anggota</h2>

        <?php
        
        // Data dari soal
        $nama_anggota = "Budi Santoso";
        $total_pinjaman = 2;
        $buku_terlambat = 1;
        $hari_keterlambatan = 5;

        // Hitung denda
        $denda_per_hari = 1000;
        $total_denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;

        // Aturan maksimal denda 50.000
        if ($total_denda > 50000) {
            $total_denda = 50000;
        }

        $level_member = "";
        switch (true) {
            case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
                $level_member = "Bronze";
                break;
            case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
                $level_member = "Silver";
                break;
            case ($total_pinjaman > 15):
                $level_member = "Gold";
                break;
            default:
                $level_member = "Belum punya level";
        }

        $pesan_status = "";
        $boleh_pinjam = true;

        if ($buku_terlambat > 0) {
            $pesan_status = "Peringatan: Ada buku yang terlambat dikembalikan! Anda tidak bisa meminjam lagi.";
            $boleh_pinjam = false;
        } elseif ($total_pinjaman >= 3) {
            $pesan_status = "Limit peminjaman sudah penuh (Maksimal 3 buku). Anda tidak bisa meminjam lagi.";
            $boleh_pinjam = false;
        } else {
            $sisa_kuota = 3 - $total_pinjaman;
            $pesan_status = "Aman. Anda masih bisa meminjam " . $sisa_kuota . " buku lagi.";
            $boleh_pinjam = true;
        }
        ?>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Anggota</h5>
            </div>
            <div class="card-body">
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Nama Anggota:</strong> <?php echo $nama_anggota; ?></li>
                    <li class="list-group-item"><strong>Level Member:</strong> <?php echo $level_member; ?></li>
                    <li class="list-group-item"><strong>Total Pinjaman:</strong> <?php echo $total_pinjaman; ?> buku</li>
                </ul>

                <h5>Status Saat Ini:</h5>
                
                <?php if ($boleh_pinjam) { ?>
                    <div class="alert alert-success">
                        <?php echo $pesan_status; ?>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger">
                        <?php echo $pesan_status; ?>
                    </div>
                <?php } ?>

                <?php if ($buku_terlambat > 0) { ?>
                    <div class="alert alert-warning mt-3">
                        <h6>Rincian Keterlambatan:</h6>
                        Jumlah buku telat: <?php echo $buku_terlambat; ?> buku <br>
                        Lama telat: <?php echo $hari_keterlambatan; ?> hari <br>
                        <strong>Total Denda: Rp <?php echo number_format($total_denda, 0, ',', '.'); ?></strong>
                        <?php if ($total_denda == 50000) echo "<small>(Limit Maksimal Denda)</small>"; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>