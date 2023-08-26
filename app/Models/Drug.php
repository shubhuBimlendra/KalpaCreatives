<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'added_by' => 'nullable|string',
        'updated_by' => 'nullable|string',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'qty' => 'required|integer|min:0',
        'approval_status' => 'required|in:Pending,Approved,Rejected',
        'approval_date' => 'nullable|date',
        'expiration_date' => 'nullable|date',
        'image' => 'required|string',
    ];
}
