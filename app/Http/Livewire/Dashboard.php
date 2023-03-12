<?php

namespace App\Http\Livewire;

use App\Models\Kerja;
use App\Models\KerjaKuliah;
use App\Models\Kuliah;
use App\Models\MencariKerja;
use App\Models\Request;
use App\Models\RequestEdit;
use App\Models\Usaha;
use App\Models\Loker;
use App\Models\User;
use Livewire\Component;
use DB;

class Dashboard extends Component
{
    public function render()
    {
        $data = [
            'all_registered' => User::count(),
            'lowongan_kerja' => Loker::count(),
            'kerja' => Kerja::count(),
            'kerja_kuliah' => KerjaKuliah::count(),
            'kuliah' => Kuliah::count(),
            'mencari_kerja' => MencariKerja::count(),
            'membuka_usaha' => Usaha::count(),
            'requestCount' => Request::where('status', 'pending')->count(),
            'requestEditCount' => RequestEdit::where(
                'status',
                'pending'
            )->count(),
        ];

        $users = User::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('MONTHNAME(created_at) as month_name')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('month_name'))
            ->orderBy('id', 'ASC')
            ->pluck('count', 'month_name');

        $labels = $users->keys();
        $chart = $users->values();

        return view(
            'livewire.admin.dashboard',
            $data,
            compact('labels', 'chart')
        )->layout('livewire.layouts.main', [
            'href' => 'Main',
            'name' => 'Dashboard',
        ]);
    }
}
