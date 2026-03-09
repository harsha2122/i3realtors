<?php

namespace App\Domains\Leads\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends Model
{
    protected $fillable = [
        'form_id',
        'label',
        'name',
        'type',
        'placeholder',
        'required',
        'options',
        'validation_rules',
        'order',
    ];

    public $timestamps = false;

    protected $casts = [
        'required' => 'boolean',
        'options' => 'json',
        'validation_rules' => 'json',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
