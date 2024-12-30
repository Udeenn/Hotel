<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'customer_name',
        'room_id',
        'check_in_date',
        'check_out_date',
        'total_price'
    ];  

    public function room(){
        return $this->belongsTo(Room::class);
    }

}
