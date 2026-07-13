<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Postingan;

class PostinganPolicy
{
    // Hanya yang punya izin ubah-postingan
    public function ubah(User $pengguna, Postingan $postingan)
    {
        return $pengguna->can('ubah-postingan');
    }

    // Hanya yang punya izin hapus-postingan
    public function hapus(User $pengguna, Postingan $postingan)
    {
        return $pengguna->can('hapus-postingan');
    }
}
