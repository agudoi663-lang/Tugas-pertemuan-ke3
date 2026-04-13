<?php

// 1. Function untuk hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}

// 2. Function untuk hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $jumlah = 0;
    foreach ($anggota_list as $agt) {
        if ($agt["status"] == "Aktif") {
            $jumlah++;
        }
    }
    return $jumlah;
}

// 3. Function untuk hitung rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    if (count($anggota_list) == 0) return 0; // Jaga-jaga kalau array kosong
    
    $total_pinjam = 0;
    foreach ($anggota_list as $agt) {
        $total_pinjam += $agt["total_pinjaman"];
    }
    return $total_pinjam / count($anggota_list);
}

// 4. Function untuk cari anggota by ID
function cari_anggota_by_id($anggota_list, $id) {
    foreach ($anggota_list as $agt) {
        if ($agt["id"] == $id) {
            return $agt;
        }
    }
    return null; 
}

// 5. Function untuk cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    $teraktif = null;
    $pinjaman_tertinggi = -1;
    
    foreach ($anggota_list as $agt) {
        if ($agt["total_pinjaman"] > $pinjaman_tertinggi) {
            $pinjaman_tertinggi = $agt["total_pinjaman"];
            $teraktif = $agt;
        }
    }
    return $teraktif;
}

// 6. Function untuk filter by status
function filter_by_status($anggota_list, $status) {
    $hasil_filter = [];
    foreach ($anggota_list as $agt) {
        if ($agt["status"] == $status) {
            $hasil_filter[] = $agt;
        }
    }
    return $hasil_filter;
}

// 7. Function untuk validasi email
function validasi_email($email) {
    // Cek: tidak kosong, ada @, ada .
    if (empty($email)) return false;
    if (strpos($email, '@') === false) return false;
    if (strpos($email, '.') === false) return false;
    return true;
}

// 8. Function untuk format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    // array nama bulan biar gampang manggilnya
    $bulan_indo = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    
    
    $pecahkan = explode('-', $tanggal);
    
    $bulan = (int)$pecahkan[1];
    
    return $pecahkan[2] . ' ' . $bulan_indo[$bulan] . ' ' . $pecahkan[0];
}



// Bonus 1: Function untuk sort anggota by nama (A-Z)
function sort_anggota_by_nama($anggota_list) {
    usort($anggota_list, function($a, $b) {
        return strcmp($a['nama'], $b['nama']);
    });
    return $anggota_list;
}

// Bonus 2: Function untuk search anggota by nama (partial match)
function search_anggota_by_nama($anggota_list, $keyword) {
    $hasil_cari = [];
    foreach ($anggota_list as $agt) {
        if (stripos($agt["nama"], $keyword) !== false) {
            $hasil_cari[] = $agt;
        }
    }
    return $hasil_cari;
}
?>