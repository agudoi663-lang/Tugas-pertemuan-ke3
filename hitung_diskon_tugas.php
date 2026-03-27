<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>
        
        <?php
        $nama_pembeli = "Andi Setiawan";
        $judul_buku = "Mahir Framework Laravel";
        $harga_satuan = 150000;
        $jumlah_beli = 7; 
        $is_member = true; 
        
        $subtotal = $harga_satuan * $jumlah_beli;
        
        $persen_diskon = 0; 
        
        if($jumlah_beli >= 1 && $jumlah_beli <= 2){
            $persen_diskon = 0;
        } else if($jumlah_beli >= 3 && $jumlah_beli <= 5) {
            $persen_diskon = 10;
        } else if($jumlah_beli >= 6 && $jumlah_beli <= 10) {
            $persen_diskon = 15;
        } else if($jumlah_beli > 10) {
            $persen_diskon = 20;
        }
        
        $diskon = $subtotal * ($persen_diskon / 100);
        
        $total_setelah_diskon1 = $subtotal - $diskon;
        
        $diskon_member = 0;
        if ($is_member == true) {
            $diskon_member = $subtotal * (5 / 100);
        }
        
        
        $total_setelah_diskon = $subtotal - $diskon - $diskon_member;
        
        $ppn = $total_setelah_diskon * 0.11;
        
        $total_akhir = $total_setelah_diskon + $ppn;
        
        $total_hemat = $diskon + $diskon_member;
        ?>
        
        <div class="row">
          <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Struk Pembelian Buku</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <strong>Nama Pembeli:</strong> <?= $nama_pembeli ?> 
                        <?php 
                        if($is_member) { 
                            echo '<span class="badge bg-success ms-2">Member</span>'; 
                        } else { 
                            echo '<span class="badge bg-secondary ms-2">Non-Member</span>'; 
                        } 
                        ?>
                    </p>
                    
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>Judul Buku</td>
                            <td>: <?php echo $judul_buku; ?></td>
                        </tr>
                        <tr>
                            <td>Harga Satuan</td>
                            <td>: Rp <?= number_format($harga_satuan, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Beli</td>
                            <td>: <?php echo $jumlah_beli; ?> Buku</td>
                        </tr>
                        <tr class="border-top">
                            <td><strong>Subtotal</strong></td>
                            <td><strong>: Rp <?= number_format($subtotal, 0, ',', '.') ?></strong></td>
                        </tr>
                        
                        <tr>
                            <td>Diskon (<?= $persen_diskon ?>%)</td>
                            <td class="text-danger">- Rp <?= number_format($diskon, 0, ',', '.') ?></td>
                        </tr>
                        
                        <?php if($is_member == true) { ?>
                        <tr>
                            <td>Diskon Member (5%)</td>
                            <td class="text-danger">- Rp <?= number_format($diskon_member, 0, ',', '.') ?></td>
                        </tr>
                        <?php } ?>
                        
                        <tr class="border-top mt-2">
                            <td>Total Setelah Diskon</td>
                            <td>: Rp <?= number_format($total_setelah_diskon, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <td>PPN (11%)</td>
                            <td class="text-warning">+ Rp <?= number_format($ppn, 0, ',', '.') ?></td>
                        </tr>
                    </table>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
                        <h4 class="mb-0">Total Bayar:</h4>
                        <h4 class="mb-0 text-primary">Rp <?= number_format($total_akhir, 0, ',', '.') ?></h4>
                    </div>
                    
                    <?php if($total_hemat > 0) { ?>
                        <div class="alert alert-success m-0 py-2 text-center">
                            Anda berhasil berhemat sebesar <strong>Rp <?= number_format($total_hemat, 0, ',', '.') ?></strong>!
                        </div>
                    <?php } ?>
                </div>
            </div>
          </div>
        </div>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>