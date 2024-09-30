<?php

use App\Models\departmentsList;
use App\Http\Livewire\VerifyOtp;
use App\Models\approvals;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Traits\MailSender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;




Route::get('register-user',function(){


   $employees = DB::table('employees')->get();  // Fetch all employees

    // Step 2: Loop through each employee and insert or update the users table
    foreach ($employees as $employee) {
        
        // Hash the default password '1234567890'
        $hashedPassword = Hash::make('1234567890');

        // Step 3: Insert into the users table (or update if the email already exists)
        User::updateOrCreate(
            ['email' => $employee->email], // Check by email to avoid duplicates
            [
                'name' => $employee->first_name.' '.$employee->last_name,
                 'department'=>$employee->department,
		 'branch'=> $employee->branch,
                'employeeId' => $employee->id,  // Assuming there's a phone number field
                'password' => $hashedPassword, // Default password
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    return "Employees data successfully transferred to users table.";


});





Route::get('/website', function (Request $request) {
    // Get the email query parameter from the request
    $email = $request->query('email');
    if($email){
        session()->put('email',$email);
    }else{
        session()->forget('email');
    }

    return redirect('/login');
});

Route::get('/', function (){
    session()->forget('email');
    return redirect('/login');
});



Route::get('/microfinance_registration_link',[\App\Http\Controllers\CompanyRequest::class,'index']);

Route::post('registration/submition',[\App\Http\Controllers\CompanyRequest::class,'create'])->name('saccossRequestForm');

// Redirect to login page
//Route::redirect('/', 'login');

// Route for password reset form submission
Route::post('/password-reset', function (Illuminate\Http\Request $request) {
    $email = $request->input('email');

    // Check if email is registered
    if (User::where('email',$email)->get()->count() == 1) {
        Session::put('status',null);

        // Create/update password reset approval process record
        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $email,
                'user_id' => null
            ],
            [
                'institution' => '',
                'process_name' => 'passwordReset',
                'process_description' => 'Password Reset request for user with email - '.$email,
                'approval_process_description' => '',
                'process_code' => '35',
                'process_id' => null,
                'process_status' => 'PENDING',
                'approval_status' => 'PENDING',
                'user_id'  => null,
                'team_id'  => '',
                'reset_email' => $email,
                'edit_package'=> null
            ]
        );

        $adminRoleId = departmentsList::where('department_name', 'ADMINISTRATION')->value('id');
        $admins = User::where('department', $adminRoleId)->get();
        foreach ($admins as $admin ){

            $this->composeEmail($admin->email, 'Dear '.$admin->name.', User '. User::where('email', $email)->value('name') .' has requested to reset his/her password');
        }

        //


        // Redirect to main dashboard page
        return redirect()->route('System');

    } else {
        // Email is not registered, redirect to password reset form with error message
        Session::put('status',"This password is not registered");
        return redirect()->route('password.request');
    }
})->name('password-reset');

// Group routes that require authentication
Route::middleware(['auth:sanctum', 'verified'])->group(function () {



    // Route for the main dashboard page
    Route::get('/System', \App\Http\Livewire\System::class)->name('System');

    // Route for OTP verification page
    Route::get('/verify-user', function () {
        return view('otp');
    })->name('verify-user');

    // Route for generating and verifying OTP
    Route::get('/CyberPoint-Pro', function () {
        $user = auth()->user(); // Get the current user

        if($user->status == 'DELETED'){
            Auth::guard('web')->logout();
            return redirect('/login');
            //return redirect()->route('login');
        }


        // Check if user already has an OTP or if the existing OTP has expired
        if ($user->otp_time) {
            if($user->verification_status == '0' || now()->diffInMinutes($user->otp_time) >= config('auth.otp_validity_period')){
                // Generate new OTP and redirect to OTP verification page
                $otp = mt_rand(100000, 999999);
                $user->otp = 111111;
//                $user->otp = $otp;
                $user->otp_time = now();
                $user->verification_status = '0';
                $user->save();
                return redirect()->route('verify-user');
            } else {
                // User has a valid OTP, redirect to main dashboard page
                Session::put('status',null);
                return redirect()->route('System');
            }
        } else {

            // Generate a new OTP and update the user's OTP record
            $otp = mt_rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_time = now();
            $user->verification_status = '0';
            $user->save();

            // Redirect the user to the OTP verification page
            return redirect()->route('verify-user');
        }



    })->name('CyberPoint-Pro');

    Route::fallback(function() {
        return view('pages/utility/404');
    });
});
