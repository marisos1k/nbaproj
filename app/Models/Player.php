<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Добавляем трейт

class Player extends Model
{
    use SoftDeletes; // Используем Soft Deletes
    
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
    ];

    protected $casts = [
        'age' => 'integer',
        'number' => 'integer',
        'ppg' => 'float',
        'rpg' => 'float',
        'apg' => 'float',
        'created_at' => 'datetime:d.m.Y H:i',
        'updated_at' => 'datetime:d.m.Y H:i',
        'deleted_at' => 'datetime', // Добавляем кастинг для deleted_at
    ];

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    public function getFormattedUpdatedAtAttribute(): string
    {
        return $this->updated_at->format('d.m.Y H:i');
    }
    
    // Добавляем форматирование для deleted_at
    public function getFormattedDeletedAtAttribute(): ?string
    {
        return $this->deleted_at ? $this->deleted_at->format('d.m.Y H:i') : null;
    }

    public function hasStats(): bool
    {
        return !is_null($this->ppg) || !is_null($this->rpg) || !is_null($this->apg);
    }
    
    // Проверяем, удален ли игрок (мягко)
    public function isTrashed(): bool
    {
        return !is_null($this->deleted_at);
    }
}