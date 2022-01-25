<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Http\Resources\Loan as LoanResource;
use App\Models\Repayment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;


class RepaymentsController extends Controller
{
    public function create(Request $request)
    {
        $loan = Loan::where('user_id', '=', auth()->user()->id)->with('user', 'repayments')->firstOrFail();
        if ($loan) {
            if(count($loan->repayments) < $loan->loan_period){
                $repayment = Repayment::create(['user_id' => auth()->user()->id, 'loan_id' => $loan->id, 'repayment_amount' => $loan->loan_amount / $loan->loan_period, 'paid_at'=> Carbon::now()]);
                if($repayment){
                    return response()->json(['success' => true, 'loan' => LoanResource::make($loan)]);
                }
                return response()->json(['success' => false, 'message' => 'Something went wrong']);
            }
            return response()->json(['success' => false, 'message' => 'No pending repayments']);
        }
        return response()->json(['success' => false, 'message' => 'User dont have any running loan.']);
    }
}
