<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CalculateArrearsPenaltiesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        Log::info('CalculateArrearsPenaltiesJob instance created.');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('CalculateArrearsPenaltiesJob started.');

        $yesterday = Carbon::yesterday();
		$today = Carbon::now();
        Log::info('Yesterday\'s date calculated: ' . $today);


        $loans = DB::table('loans_schedules')
            //->whereIn('completion_status', ['PARTIAL', 'PENDING'])
			->where('completion_status','PARTIAL')
			->orWhere('completion_status','PENDING')
            ->where('installment_date', '<=', $yesterday)
            ->get();

        //Log::info('Loans retrieved from the database.', ['loans_count' => $loans]);

        foreach ($loans as $loan) {
            //Log::info('Processing loan.', ['loan_id' => $loan->id]);

            $daysInArrears = $today->diffInDays(Carbon::parse($loan->installment_date));
            $penalty = ($loan->principle * 0.00) * $daysInArrears;
            $amountInArrears = $loan->installment - $loan->payment;

            Log::info('Calculated values for loan.', [
                'loan_id' => $loan->id,
                'days_in_arrears' => $daysInArrears,
                'penalty' => $penalty,
                'amount_in_arrears' => $amountInArrears
            ]);

            DB::table('loans_schedules')
                ->where('id', $loan->id)
                ->update([
                    'days_in_arrears' => $daysInArrears,
                    'penalties' => $penalty,
                    'amount_in_arrears' => $amountInArrears,
                ]);

            //Log::info('Updated loan in database.', ['loan_id' => $loan->id]);
        }

        Log::info('CalculateArrearsPenaltiesJob completed.');
    }




}
