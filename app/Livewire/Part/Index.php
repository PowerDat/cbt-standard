<?php

namespace App\Livewire\Part;

use App\Models\Part;
use App\Models\PartType;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $model = Part::paginate(10);
        $type = PartType::all();
        
        return view('livewire.part.index', [
            'model' => $model,
            'type' => $type,
        ]);
    }
}
