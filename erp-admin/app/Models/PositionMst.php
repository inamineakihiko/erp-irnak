<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\PositionMst
 *
 * @property string $uuid
 * @property int $position_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PositionMst onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PositionMst withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PositionMst withoutTrashed()
 * @mixin \Eloquent
 */
final class PositionMst extends Model
{
    use HasFactory, SoftDeletes;
    /** @var string ??????????????????????????????????????? */
    protected $primaryKey = 'uuid';
    /** @var string ?????????????????????????????? */
    protected $keyType = 'string';
    /** @var string ???????????????????????????????????? */
    public $incrementing = false;
    /** @var array ???????????? */
    protected $dates = ['deleted_at'];
    /** @var array ????????? */
    protected $guarded = ['uuid'];

    /**
     * @param array $attributes = []
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // new????????????????????????uuid??????????????????
        $this->attributes['uuid'] = Uuid::uuid4()->toString();
    }

    /**
     * ??????????????????
     */
    public function profile()
    {
        return $this->belongsTo('App\Models\Profile', 'position_id', 'position_id');
    }
}
