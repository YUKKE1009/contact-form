<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // 一括代入を許可するカラム
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    /**
     * Category とのリレーション
     * contacts.category_id → categories.id
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
