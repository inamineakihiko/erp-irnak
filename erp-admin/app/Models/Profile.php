<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\Profile
 *
 * @property string $uuid
 * @property string|null $erp_id
 * @property string $name
 * @property string $kana
 * @property string $birthday
 * @property int|null $birthplace
 * @property int $gender
 * @property bool|null $spouse
 * @property int|null $enducational_background
 * @property string $postal_code
 * @property int $prefectural
 * @property string $address
 * @property string|null $nearest_station
 * @property string $email
 * @property string $contact_number
 * @property string|null $emergency_contact_number
 * @property int|null $recruitment_classification
 * @property int $belong_id
 * @property int $affiliation_dept_id
 * @property int $position_id
 * @property int $employee_div_id
 * @property int $business_div_id
 * @property string|null $joined_at
 * @property string|null $retirement_at
 * @property string|null $operation_destination_name
 * @property string|null $operation_destination
 * @property string|null $business_content
 * @property array|null $possession_qualification
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\AffiliationDeptMst $affiliationDeptMst
 * @property-read \App\Models\BelongMst $belongMst
 * @property-read \App\Models\BusinessDivMst $businessDivMst
 * @property-read \App\Models\EmployeeDivMst $employeeDivMst
 * @property-read \App\Models\Fare|null $fare
 * @property-read \App\Models\OnetimeToken $onetimeToken
 * @property-read \App\Models\PositionMst $positionMst
 * @property-read \App\Models\User|null $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereAffiliationDeptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBelongId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBusinessContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBusinessDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereEmergencyContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereEmployeeDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereEnducationalBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereErpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereJoinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereNearestStation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereOperationDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereOperationDestinationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePossessionQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePrefectural($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereRecruitmentClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereRetirementAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereSpouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile withoutTrashed()
 * @mixin \Eloquent
 */
final class Profile extends Model
{
    use HasFactory, SoftDeletes;
    /** @var array ???????????? */
    protected $dates = ['deleted_at'];
    /** @var array ????????? */
    protected $guarded = ['uuid'];
    /** @var array ?????????????????????????????????????????????????????? */
    protected $casts = [
        'spouse' => 'boolean',
        'possession_qualification' => 'array'
    ];
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
     * ?????????????????????????????????????????????User?????????
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'erp_id', 'erp_id')->withTrashed();
    }

    /**
     * ????????????????????????????????????
     */
    public function onetimeToken()
    {
        return $this->hasOne('App\Models\OnetimeToken', 'erp_id', 'erp_id');
    }

    /**
     * ?????????????????????
     */
    public function belongMst()
    {
        return $this->hasOne('App\Models\BelongMst', 'belong_id', 'belong_id');
    }

    /**
     * ???????????????????????????
     */
    public function affiliationDeptMst()
    {
        return $this->hasOne('App\Models\AffiliationDeptMst', 'affiliation_dept_id', 'affiliation_dept_id');
    }

    /**
     * ?????????????????????
     */
    public function positionMst()
    {
        return $this->hasOne('App\Models\PositionMst', 'position_id', 'position_id');
    }

    /**
     * ?????????????????????
     */
    public function employeeDivMst()
    {
        return $this->hasOne('App\Models\EmployeeDivMst', 'employee_div_id', 'employee_div_id');
    }

    /**
     * ???????????????????????????
     */
    public function businessDivMst()
    {
        return $this->hasOne('App\Models\BusinessDivMst', 'business_div_id', 'business_div_id');
    }

    /**
     * ??????????????????
     *
     * @param string $value
     * @return void
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = Crypt::encryptString($value);
    }

    /**
     * ???????????????
     *
     * @param string $value
     * @return string
     */
    public function getNameAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * ??????????????????????????????
     *
     * @param string $value
     * @return void
     */
    public function setKanaAttribute(string $value)
    {
        $this->attributes['kana'] = Crypt::encryptString($value);
    }

    /**
     * ???????????????????????????
     *
     * @param string $value
     * @return string
     */
    public function getKanaAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * ????????????????????????
     *
     * @param string $value
     * @return void
     */
    public function setPostalCodeAttribute(string $value)
    {
        $this->attributes['postal_code'] = Crypt::encryptString($value);
    }

    /**
     * ?????????????????????
     *
     * @param string $value
     * @return string
     */
    public function getPostalCodeAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * ??????????????????
     *
     * @param string $value
     * @return void
     */
    public function setAddressAttribute(string $value)
    {
        $this->attributes['address'] = Crypt::encryptString($value);
    }

    /**
     * ???????????????
     *
     * @param string $value
     * @return string
     */
    public function getAddressAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * ?????????????????????
     *
     * @param string|null $value
     * @return void
     */
    public function setNearestStationAttribute(?string $value)
    {
        $this->attributes['nearest_station'] = is_null($value) ? $value : Crypt::encryptString($value);
    }

    /**
     * ??????????????????
     *
     * @param string|null $value
     * @return string|null
     */
    public function getNearestStationAttribute(?string $value): ?string
    {
        return is_null($value) ? $value : Crypt::decryptString($value);
    }

    /**
     * ?????????????????????????????????
     *
     * @param string $value
     * @return void
     */
    public function setEmailAttribute(string $value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }

    /**
     * ??????????????????????????????
     *
     * @param string $value
     * @return string
     */
    public function getEmailAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * ?????????????????????
     *
     * @param string $value
     * @return void
     */
    public function setContactNumberAttribute(string $value)
    {
        $this->attributes['contact_number'] = Crypt::encryptString($value);
    }

    /**
     * ??????????????????
     *
     * @param string $value
     * @return string
     */
    public function getContactNumberAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * ???????????????????????????
     *
     * @param string|null $value
     * @return void
     */
    public function setEmergencyContactNumberAttribute(?string $value)
    {
        $this->attributes['emergency_contact_number'] = is_null($value) ? $value : Crypt::encryptString($value);
    }

    /**
     * ????????????????????????
     *
     * @param string|null $value
     * @return string|null
     */
    public function getEmergencyContactNumberAttribute(?string $value): ?string
    {
        return is_null($value) ? $value : Crypt::decryptString($value);
    }
}
