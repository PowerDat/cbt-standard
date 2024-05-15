<?php

namespace App\Livewire\PartTarget;

use Livewire\Component;
use App\Models\PartTarget;
use Livewire\WithPagination;
use App\Models\PartTargetSub;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $partTarget = PartTarget::paginate(10);
        $partTargetSub = DB::select('SELECT DISTINCT(part_target_id) FROM part_target_sub');

        return view('livewire.part-target.index', [
            'partTarget' => $partTarget,
            'partTargetSub' => $partTargetSub,
        ]);
    }
}
