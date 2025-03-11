<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'word', 'score'];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public static function wordAlreadyUsed($gameId, $word): bool
    {
        return self::where('game_id', $gameId)->where('word', $word)->exists();
    }
}
