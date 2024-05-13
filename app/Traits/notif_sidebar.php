<?php

namespace App\Traits;

use App\Models\GeneralModel;

trait notif_sidebar
{
    public function approval_pending()
    {
        $this->model = new GeneralModel();

        $data = [
            // 'count_all_pending' => $this->model->get_all_pending(),
            'count_pengarsipan_pending' => $this->model->get_pengarsipan_pending(),
            'count_peminjaman_pending' => $this->model->get_peminjaman_pending(),
            'count_pengembalian_pending' => $this->model->get_pengembalian_pending(),
            'count_pengarsipan_pending_ruangan' => $this->model->get_pengarsipan_pending_ruangan(),
            'count_peminjaman_pending_ruangan' => $this->model->get_peminjaman_pending_ruangan(),
            'count_pengembalian_pending_ruangan' => $this->model->get_pengembalian_pending_ruangan(),
        ];
        return $data;
    }
}
