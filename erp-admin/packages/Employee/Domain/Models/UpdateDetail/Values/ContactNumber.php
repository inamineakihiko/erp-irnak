<?php
declare(strict_types=1);

namespace Employee\Domain\Models\UpdateDetail\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class ContactNumber extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '連絡先';

    /**
     * Store a new controller instance.
     *
     * @param mixed $value
     * @return void
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     * 電話番号かチェック
     *
      * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return parent::isPhoneNumber($value);
    }
}
