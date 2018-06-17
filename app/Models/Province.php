<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Gate;

/**
 * App\Models\Province.
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed $can_delete
 * @property mixed $can_edit
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Province extends Model
{
    protected $fillable = ['code', 'name', 'kh_name', 'reference', 'country_id'];

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
     * @return HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
