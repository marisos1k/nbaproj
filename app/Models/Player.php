<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Добавляем

class Player extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'fullname',
        'position',
        'team',
        'number',
        'img_url',
        'height',
        'weight',
        'age',
        'ppg',
        'rpg',
        'apg',
        'bio',
        'user_id',
    ];

    protected $casts = [
        'age' => 'integer',
        'number' => 'integer',
        'ppg' => 'float',
        'rpg' => 'float',
        'apg' => 'float',
        'created_at' => 'datetime:d.m.Y H:i',
        'updated_at' => 'datetime:d.m.Y H:i',
        'deleted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    public function getFormattedUpdatedAtAttribute(): string
    {
        return $this->updated_at->format('d.m.Y H:i');
    }
    
    public function getFormattedDeletedAtAttribute(): ?string
    {
        return $this->deleted_at ? $this->deleted_at->format('d.m.Y H:i') : null;
    }

    public function hasStats(): bool
    {
        return !is_null($this->ppg) || !is_null($this->rpg) || !is_null($this->apg);
    }
    
    public function isTrashed(): bool
    {
        return !is_null($this->deleted_at);
    }
    

    public function belongsToUser($user): bool
    {
        return $this->user_id === $user->id;
    }
}