<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

/**
 * App\Models\Country.
 *
 * @property int $id
 * @property string $name
 * @property array $message
 * @property string|null $recipients
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed $array_recipients
 * @property mixed $can_delete
 * @property mixed $can_edit
 * @property mixed $html_message
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Country extends Model
{
    protected $fillable = ['name', 'kh_name', 'slug', 'description', 'status'];

    protected $casts = [
        'status' => 'boolean'
    ];

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
}
