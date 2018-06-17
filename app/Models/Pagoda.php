<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Gate;

/**
 * App\Models\Pagoda.
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed $can_delete
 * @property mixed $can_edit
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagoda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagoda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagoda whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagoda whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pagoda extends Model
{
    protected $fillable = ['address', 'name', 'kh_name', 'about', 'village_id', 'history', 'user_id', 'slug', 'website'];

    /**
     * @var array
     */
    protected $appends = ['can_edit', 'can_delete'];

    /**
     * @return bool
     */
    public function getCanEditAttribute()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getCanDeleteAttribute()
    {
        return Gate::check('delete metas');
    }

    /**
     * @return BelongsTo
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
