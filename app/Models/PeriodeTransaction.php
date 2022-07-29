<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'transaction_details_id',
        'started_at',
        'finished_at',
        'created_at',
        'updated_at',
        'status',
    ];

    public function transaction_detail()
    {
        return $this->hasOne(TransactionDetail::class, 'id', 'transaction_details_id');
    }
}
