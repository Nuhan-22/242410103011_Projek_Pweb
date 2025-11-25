<?php

namespace App\Helpers\Enum;

enum StatusTiket : string {
    case ACTIVE = 'Aktif';
    case USED = 'Telah dipakai';
    case EXPIRED = 'Kadaluarsa';
}
