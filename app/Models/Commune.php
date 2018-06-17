<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Gate;

/**
 * App\Models\Commune.
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed $can_delete
 * @property mixed $can_edit
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commune whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commune whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commune whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commune whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Commune extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'kh_name', 'reference', 'district_id'];
    /**
     * @var array
     */
    protected $with = ['district'];
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
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
