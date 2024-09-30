<?php

namespace App\Http\Livewire\Loans;

use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;
use App\Models\Guarantor;
use Illuminate\Support\Facades\Session;


class GuarantorTable extends LivewireDatatable
{
 
  function builder(){

	  $query = Guarantor::query()->where('loan_id',Session::get('currentloanID'));

	  return $query;
  }




	public function columns(): array
{
    return [

        // Display Guarantor's Full Name (combine first, middle, and last name)
        Column::callback(['id'], function ($id) {
            $guarantor = DB::table('guarantors')->where('id', $id)->first();
            return $guarantor->name;
        })->label('Guarantor Name'),

        // Display Date of Birth (dob)
        Column::name('dob')
            ->label('Date of Birth')
            ->searchable(),

        // Display Nationality
        Column::name('nationality')
            ->label('Nationality')
            ->searchable(),

        // Display Address
        Column::name('address')
            ->label('Address')
            ->searchable(),

        // Display Phone Number
        Column::name('phone')
            ->label('Phone Number')
            ->searchable(),

        // Display Email
        Column::name('email')
            ->label('Email Address')
            ->searchable(),

        // Display National ID (id_number)
        Column::name('id_number')
            ->label('National ID')
            ->searchable(),

        // Display Employment Status
        Column::name('employment_status')
            ->label('Employment Status'),

        // Display Employer Details
        Column::name('employer_details')
            ->label('Employer Details'),

        // Display Guarantee Type (guaranteeType)
        Column::name('guaranteeType')
            ->label('Guarantee Type'),

        // Display Loan ID (loan_id)
        Column::name('loan_id')
            ->label('Loan ID'),

        // Display Guarantor Image (image)
        Column::callback('image', function ($image) {
            return '<img src="' . asset('storage/' . $image) . '" alt="Guarantor Image" class="h-10 w-10 rounded-full">';
        })->label('Image'),

        // Display Created At (created_at)
        Column::name('created_at')
            ->label('Created At'),

        // Display Updated At (updated_at)
        Column::name('updated_at')
            ->label('Updated At'),
    ];
}





}
