<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Gate;

/**
 * App\Models\Village.
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed $can_delete
 * @property mixed $can_edit
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Village whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Village whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Village whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Village whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Village extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'kh_name', 'reference', 'commune_id'];
    /**
     * @var array
     */
    protected $with = ['commune'];
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
    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }
}
