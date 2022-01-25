<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Loan as LoanModel;
use App\Http\Resources\Repayment as RepaymentResource;

class Loan extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = [
            LoanModel::STATUS_PENDING => 'Pending',
            LoanModel::STATUS_APPROVED => 'Approved',
        ];

        return [
            'id' => (int)$this->id,
            'user' => auth()->user()->name,
            'loan_amount' => number_format($this->loan_amount, 2),
            'loan_period' => $this->loan_period,
            'repayment_frequency' => $this->repayment_frequency,
            'weekly_repayment_amount' => $this->loan_amount / $this->loan_period,
            'status' => $status[$this->status],
            'repayments' => RepaymentResource::collection($this->whenLoaded('repayments')),
        ];
    }
}
