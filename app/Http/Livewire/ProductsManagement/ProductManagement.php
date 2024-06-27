<?php

namespace App\Http\Livewire\ProductsManagement;
use App\Models\sub_products;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ProductManagement extends Component
{

    public $tab_id;
    public $title;
    public $activeProductsCount;
    public $inactiveProductsCount;
    public $ProductsList;

    protected $listeners = ['refreshProductListComponent', '$refresh'];

    //protected $listeners = ['refreshProductListComponent'];

    public function refreshProductListComponent(){
        $this->render();
    }

    public function boot(){
        $this->tab_id = '1';
        $this->title = 'Hisa Products Management';
        Session::put('ProductID','11');
    }


    public function menuItemClicked($tabId){
        $this->tab_id = $tabId;
        if($tabId == '1'){
            $this->title = 'Hisa Products Management';
            Session::put('ProductID','11');
        }
        if($tabId == '2'){
            $this->title = 'Amana Products Management';
            Session::put('ProductID','12');
        }
        if($tabId == '3'){
            $this->title = 'Deposits Products Management';
            Session::put('ProductID','13');
        }
        if($tabId == '4'){
            $this->title = 'Loans Products Management';
            Session::put('ProductID','14');
        }
    }


    public function render()
    {
         $this->activeProductsCount = sub_products::where('sub_product_status', 1)->count();
        $this->inactiveProductsCount = sub_products::where('sub_product_status', 2)->count();
        $this->ProductsList = sub_products::get();
        return view('livewire.products-management.product-management');
    }
}
