<?php

namespace App\Http\Livewire\Modules;

use Carbon\Carbon;

trait BaseTable
{
    public $filter;
    public $from;
    public $to;
    public $search;
    public $filter_date;
    public $byYear = false;

    public function closeAll()
    {
    }

    public function updatedBase($fields)
    {
        if ($fields == 'to' || $fields == 'from') {
            if ($this->byYear) {
                $this->validate([
                    'from' => 'required|numeric|digits:4',
                    'to' => 'required_with:from|numeric|digits:4',
                ]);
            } else {
                $this->validate([
                    'from' => 'required',
                    'to' => 'required_with:from|date|after:from',
                ]);
            }

            return;
        }
        if ($fields == 'search') {
            return;
        }
        $this->validateOnly($fields);
    }

    public function clearFilter()
    {
        $this->from = '';
        $this->to = '';
        $this->closeAll();
        $this->filter_date = false;
        $this->filter = false;
    }

    public function updatedTo()
    {
        if ($this->byYear) {
            $this->validate([
                'from' => 'required|numeric|digits:4',
                'to' =>
                    'required_with:from|numeric|digits:4|after_or_equal:from',
            ]);
        } else {
            $this->validate([
                'from' => 'required',
                'to' => 'required_with:from|date|after_or_equal:from',
            ]);
            $this->from = Carbon::parse($this->from)->format('Y-m-d');
            $this->to = Carbon::parse($this->to)->format('Y-m-d');
        }
        $this->filter_date = true;
        $this->filter = true;
        $this->closeAll();
    }

    public function filterUsingYear($fieldName = 'tahun_kerja')
    {
        $this->byYear = $fieldName;
    }

    public function baseRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('name', 'like', '%' . $this->search . '%');
            $models->orWhere(
                'jenis_kelamin',
                'like',
                '%' . $this->search . '%'
            );
        }

        if ($this->filter_date) {
            if ($this->byYear) {
                $models
                    ->where($this->byYear, '<=', $this->to)
                    ->where($this->byYear, '>=', $this->from);
            } else {
                $models
                    ->whereDate('created_at', '<=', $this->to)
                    ->whereDate('created_at', '>=', $this->from);
            }
        }

        return $models;
    }

    public function requestAddRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('table_type', 'like', '%' . $this->search . '%');
            $models->orWhere('user_id', 'like', '%' . $this->search . '%');
            $models->orWhere('relasi_id', 'like', '%' . $this->search . '%');
            $models->orWhere('status', 'like', '%' . $this->search . '%');
            $models->orWhere('handled_by', 'like', '%' . $this->search . '%');
            $models->orWhere('created_at', 'like', '%' . $this->search . '%');
        }

        return $models;
    }

    public function requestEditRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('id_container', 'like', '%' . $this->search . '%');
            $models->orWhere('id_user', 'like', '%' . $this->search . '%');
            $models->orWhere('id_table', 'like', '%' . $this->search . '%');
            $models->orWhere('table_type', 'like', '%' . $this->search . '%');
            $models->orWhere('status', 'like', '%' . $this->search . '%');
            $models->orWhere('handled_by', 'like', '%' . $this->search . '%');
            $models->orWhere('created_at', 'like', '%' . $this->search . '%');
        }

        return $models;
    }

    public function userRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('name', 'like', '%' . $this->search . '%');
            $models->orWhere('email', 'like', '%' . $this->search . '%');
            $models->orWhere('slug', 'like', '%' . $this->search . '%');
            $models->orWhere('created_at', 'like', '%' . $this->search . '%');
        }

        return $models;
    }

    public function lokerRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('title', 'like', '%' . $this->search . '%');
            $models->orWhere('description', 'like', '%' . $this->search . '%');
            $models->orWhere(
                'qualification',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere('contact', 'like', '%' . $this->search . '%');
        }

        return $models;
    }

    public function kerjaRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('name', 'like', '%' . $this->search . '%');
            $models->orWhere(
                'jenis_kelamin',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere(
                'nama_perusahaan',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere('jabatan', 'like', '%' . $this->search . '%');
            $models->orWhere('tahun_kerja', 'like', '%' . $this->search . '%');
            $models->orWhere('dibuat', 'like', '%' . $this->search . '%');
        }

        return $models;
    }

    public function kuliahRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('name', 'like', '%' . $this->search . '%');
            $models->orWhere(
                'jenis_kelamin',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere(
                'nama_universitas',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere('jurusan', 'like', '%' . $this->search . '%');
            $models->orWhere('dibuat', 'like', '%' . $this->search . '%');
        }

        return $models;
    }

    public function kerjaKuliahRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('name', 'like', '%' . $this->search . '%');
            $models->orWhere(
                'jenis_kelamin',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere(
                'nama_perusahaan',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere(
                'nama_universitas',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere('jabatan', 'like', '%' . $this->search . '%');
            $models->orWhere('jurusan', 'like', '%' . $this->search . '%');
            $models->orWhere('tahun_kerja', 'like', '%' . $this->search . '%');
            $models->orWhere('dibuat', 'like', '%' . $this->search . '%');
        }

        return $models;
    }

    public function mencariKerjaRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('name', 'like', '%' . $this->search . '%');
            $models->orWhere(
                'jenis_kelamin',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere('alamat', 'like', '%' . $this->search . '%');
            $models->orWhere(
                'alasan_mencari_kerja',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere('kontak', 'like', '%' . $this->search . '%');
            $models->orWhere('dibuat', 'like', '%' . $this->search . '%');
        }

        return $models;
    }

    public function membukaUsahaRender($model)
    {
        header('referrer-policy:same-origin');

        $models = $model::latest();

        if ($this->search != '') {
            $models->where('name', 'like', '%' . $this->search . '%');
            $models->orWhere(
                'jenis_kelamin',
                'like',
                '%' . $this->search . '%'
            );
            $models->orWhere('jenis_usaha', 'like', '%' . $this->search . '%');
            $models->orWhere('alamat_usaha', 'like', '%' . $this->search . '%');
            $models->orWhere('tahun_usaha', 'like', '%' . $this->search . '%');
            $models->orWhere('dibuat', 'like', '%' . $this->search . '%');
        }

        return $models;
    }
}
