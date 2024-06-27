<?php

namespace App\Http\Livewire\Members;

use App\Models\BranchesModel;
use App\Models\Employee;
use App\Models\LoansModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


use App\Models\MembersModel;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class MembersTable extends LivewireDatatable
{

    protected $listeners = ['refreshMembersTable' => '$refresh'];
    public $exportable = true;


    public function builder()
    {

        return MembersModel::query();
    }

    public function viewMember($memberId){
        Session::put('memberToViewId',$memberId);
//        dd(Session::get('memberToViewId'));

        $this->emit('viewMemberDetails');
    }
    public function editMember($memberId,$name){
        Session::put('memberToEditId',$memberId);
        Session::put('memberToEditName',$name);
        $this->emit('refreshMembersListComponent');
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {
        return [

            Column::callback(['first_name','middle_name','last_name'],function($first_name,$middle_name,$last_name){

                return $first_name.' '.$middle_name.' '.$last_name;
            })
                ->label('Member name')->searchable(),

//            Column::callback('branch',function($id){
//                return BranchesModel::where('id',$id)->value('name');
//            })
//                ->label('branch'),

            Column::name('member_number')
                ->label('Member number')->searchable(),

//            Column::callback(['branch','client_number'],function ($branch,$client_number){
//                return LoansModel::where('client_number',$client_number)->where('status','ACTIVE')->count();
//            })
//                ->label('active loans'),

             Column::name('phone_number')
                 ->label('phone number')->searchable(),


            Column::name('tawi')
                ->label('Tawi'),

            Column::name('ward')
                ->label('Ward'),

            Column::callback(['member_number'],function ($member_number){
                return number_format(DB::table('accounts')->where('member_number',$member_number)->where('sub_category_code','2220')->value('balance'));
            })->label('savings'),


                Column::callback(['client_status'], function ($status) {
                    return view('livewire.branches.table-status', ['status' => $status, 'move' => false]);
                })->label('status'),


                Column::callback(['id'], function ($id) {
                    return view('livewire.members.action-buttons', ['id' => $id, 'move' => false]);
                })->unsortable()->label('Action'),


        ];
    }


    public function viewLoans($id,$client_number){


        $client_number=DB::table('clients')->where('id',$id)->value('client_number');

        $this->emit('viewMemberLoans',$client_number);
    }


    public function edit($id){
        $this->emitUp('editMember',$id);
        }
        public function block($id){
        $this->emitUp('blockMember',$id);
        }
        public function viewMembers($id){

        $this->emitUp('viewMemberDetails',$id);
        }


}
