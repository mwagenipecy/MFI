<?php

namespace App\Http\Livewire\ProductsManagement;

use Livewire\Component;

class Loans extends Component
{
    public $currentView;

    protected $listeners = ['refreshProductListComponent' => '$refresh'];

    public function boot()
    {
        $this->currentView = 0;
    }

    public function setView($id)
    {
        $this->currentView = $id;
        $this->emit('mount', $id);
    }
    
    public function render()
    {
        return view('livewire.products-management.loans');
    }
}
