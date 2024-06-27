<?php

namespace App\Http\Livewire\ProductsManagement;

use Livewire\Component;
use App\Models\Currencies;
use App\Models\sub_products;

class Shares extends Component
{
    protected $listeners = ['refreshProductListComponent' => '$refresh'];

    public function render()
    {

        return view('livewire.products-management.shares');
    }


}
