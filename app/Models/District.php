<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Gate;

/**
 * App\Models\District.
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed $can_delete
 * @property mixed $can_edit
 * @property \App\Models\Province|null $province
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District withProvince(\App\Models\Province $province)
 * @mixin \Eloquent
 */
class District extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'kh_name', 'reference', 'province_id'];

    protected $with = ['province'];
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
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Models\Province $province
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithProvince(Builder $query, Province $province)
    {
        return $query->where('province_id', '=', $province->id);
    }
}
