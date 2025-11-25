<?php

namespace App\Helpers\Enum;

enum StatusPesananTiket : string {
    case DIPROSES = 'Menunggu'; // Menunggu diterima Admin
    case SELESAI  = 'Diterima'; // Selesai Diterima Admin
    case DITOLAK  = 'Ditolak'; // Pesanan Ditolak
}
