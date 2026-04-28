<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable =[
        'title',
        'amount',
        'spent_at',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeExpensive($query){
        return $query -> where('amount','>',100);
    }

    public function scopeCheap($query){
        return $query-> where('amount','<',50);
    }

    public function getFormattedAmountAttribute(){
        return $this->amount.'$';
    }

    public function getAmountLabelAttribute(){
        if($this->amount < 50){
            return 'Cheap';
        }elseif($this->amount>100){
            return 'Expensive';
        }else{
            return 'Normal';
        }
    }
}
