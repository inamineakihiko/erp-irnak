<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\AffiliationDeptMst
 *
 * @property string $uuid
 * @property int $affiliation_dept_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AffiliationDeptMst onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereAffiliationDeptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AffiliationDeptMst withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AffiliationDeptMst withoutTrashed()
 * @mixin \Eloquent
 */
final class AffiliationDeptMst extends Model
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
        return $this->belongsTo('App\Models\Profile', 'affiliation_dept_id', 'affiliation_dept_id');
    }
}
