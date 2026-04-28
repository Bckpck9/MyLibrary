<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'price',
        'published_at',
        'is_available',
        'category_id',
        'user_id',
        'cover_image'
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopeExpensive($query){
        return $query->where('price', '>', 1000);
    }

    public function scopeAvailable($query){
        return $query->where('is_available',true);
    }

    public function getAvailabilityLabelAttribute(){
        return $this->is_available ? 'Avaible' : 'Not Avaible';
    }

    public function getFormattedpriceAttribute(){
        return $this->price.' $';
    }

    public function scopeOrderPrice($query){
        return $query->orderBy('price');
    }

    public function scopeSearching($query,$search){
        return $query->where('title','like','%'.$search.'%');
    }

    public function scopeCategory($query,$categoryId){
        return $query->where('category_id', $categoryId);
    }

    public function scopeIdFilter($query){
        return $query->where('user_id',auth()->id());//ошибки нету, интерпритатор показывает фейк
    }
}
