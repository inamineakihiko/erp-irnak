<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\EmployeeDivMst
 *
 * @property string $uuid
 * @property int $employee_div_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EmployeeDivMst onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereEmployeeDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EmployeeDivMst withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EmployeeDivMst withoutTrashed()
 * @mixin \Eloquent
 */
final class EmployeeDivMst extends Model
{
    use HasFactory, SoftDeletes;
    /** @var array ???????????? */
    protected $dates = ['deleted_at'];
    /** @var array ????????? */
    protected $guarded = ['uuid'];
    /** @var string ??????????????????????????????????????? */
    protected $primaryKey = 'uuid';
    /** @var string ?????????????????????????????? */
    protected $keyType = 'string';
    /** @var string ???????????????????????????????????? */
    public $incrementing = false;

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
        return $this->belongsTo('App\Models\Profile', 'employee_div_id', 'employee_div_id');
    }
}
