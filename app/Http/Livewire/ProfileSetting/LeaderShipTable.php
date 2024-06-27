<?php

namespace App\Http\Livewire\ProfileSetting;

use App\Models\LeaderShipModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LeaderShipTable extends LivewireDatatable
{

    public $exportable=true;

    public function builder()
    {

        return LeaderShipModel::query()->where('institution_id',auth()->user()->institution_id);

    }


    public function columns()
    {
        return [
            Column::name('id')->label('id'),
            Column::name('image')->label('photo'),
            Column::name('full_name')->label('name')->searchable(),
            Column::name('position')->label('position')->searchable(),
            Column::name('startDate')->label('start date'),
            Column::name('endDate')->label('end Date'),
        ];
    }
}
