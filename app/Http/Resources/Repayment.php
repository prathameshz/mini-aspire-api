<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Repayment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'user' => auth()->user()->name,
            'repayment_amount' => number_format($this->repayment_amount, 2),
            'paid_at' => $this->paid_at,
            'repayment_paid' => $this->loan->repayments()->count(),
        ];
    }
}
