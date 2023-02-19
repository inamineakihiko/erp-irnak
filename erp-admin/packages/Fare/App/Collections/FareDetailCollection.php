<?php
declare(strict_types=1);

namespace Fare\App\Collections;

use Fare\Infrastructure\Base\Model\BaseCollection;

/**
 * FareDetailCollection
 */
class FareDetailCollection extends BaseCollection
{
    /**
     * @param array $value
     * @return void
     */
    public function __construct(array $value = [])
    {
        parent::__construct($value);
    }
}
