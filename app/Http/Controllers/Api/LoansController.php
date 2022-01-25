<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Http\Resources\Loan as LoanResource;
use Illuminate\Support\Facades\Validator;


class LoansController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'loan_amount' => 'required|integer',
            'loan_period' => 'required|integer',
        ];

        $input = $request->only('loan_amount', 'loan_period');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        #try {
        $loan = Loan::where('user_id', auth()->user()->id)
            ->whereIn('status', [Loan::STATUS_PENDING, Loan::STATUS_APPROVED])
            ->exists();
        if ($loan === false) {
            $loan = Loan::create(['user_id' => auth()->user()->id, 'loan_amount' => $request->loan_amount, 'loan_period' => $request->loan_period, 'repayment_frequency' => Loan::REPAYMENT_FREQUENCY, 'status' => Loan::STATUS_APPROVED]);
            return response()->json(['success' => true, ['loan' => LoanResource::make($loan)]]);;
        }

        return response()->json(['success' => false, 'error' => 'Unable to create Loan as User already have running loan.']);
    }

    public function show(Request $request)
    {
        $loan = Loan::where('user_id', '=', auth()->user()->id)->with('user','repayments')->firstOrFail();
        if ($loan) {
            return response()->json(['success' => true, 'loan' => LoanResource::make($loan)]);
        }
        return response()->json(['success' => false, 'message' => 'This user dont have active loan.']);
    }
}
