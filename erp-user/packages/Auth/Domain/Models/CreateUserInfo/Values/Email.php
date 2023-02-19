<?php
declare(strict_types=1);

namespace Auth\Domain\Models\CreateUserInfo\Values;

use Auth\Infrastructure\Bass\Model\BaseValue;

final class Email extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'メールアドレス';

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
        return parent::isEmail($value);
    }

    /**
     * ハッシュされたメールアドレスを返す
     *
     * @return string
     */
    public function getHashedValue(): string
    {
        return hash('sha256', $this->value);
    }
}
