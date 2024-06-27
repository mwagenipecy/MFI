<?php

namespace App\Http\Livewire\Settings;

use App\Models\approvals;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\NodesList;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Branches;
use App\Models\Department;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Illuminate\Support\Facades\Session;
use App\Models\search;
class Users extends LivewireDatatable
{
    use WithFileUploads;

    public $exportable = true;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Employee::query();
    }

    public function columns(): array
    {
        return [
            Column::name('id')
                ->label('Employee Number')->searchable(),
            Column::callback(['first_name','middle_name','last_name'], function($first_name,$middle_name,$last_name){

                return $first_name.' '.$middle_name.' '.$last_name;})
                ->label('Name')->searchable(),
            Column::callback('branch',function ($branchId){
                return Branches::where('id',$branchId)->value('name');
            })
                ->label('Branch')->searchable(),
            Column::callback('department',function($departmentId){
                return Department::where('id',$departmentId)->value('department_name');
            })
                ->label('Department')->searchable(),
            Column::name('job_title')
                ->label('Title'),
            Column::name('phone')
                ->label('Phone Number'),
            Column::name('created_at')
                ->label('Start Date'),
            Column::name('employee_status')
                ->label('Status'),
            Column::callback(['ID'], function ($id) {
                return view('livewire.settings.users-list-action', ['id' => $id, 'move' => false]);
            })->unsortable()->label('Action')
        ];





    }

    public function edit($id){
    $this->emitUp('editUser',$id);
    }

    public function block($id){
    $this->emitUp('blockUser',$id);
    }

}
