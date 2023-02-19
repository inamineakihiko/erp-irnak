<?php
declare(strict_types=1);

namespace Fare\Domain\Models\UpdateDetail\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

final class AmountOfMoney extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '金額';

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
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return is_int($value);
    }
}