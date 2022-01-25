<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Loan extends Model
{
    use HasFactory;
    use Notifiable;
    public const STATUS_PENDING = 0;
    public const STATUS_APPROVED = 1;
    
    public const REPAYMENT_FREQUENCY = 1;//weekly

    protected $fillable = ['user_id','loan_amount','loan_period','repayment_frequency','status'];

    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
