<?php

namespace WPWhales\Support;

use Carbon\Carbon as BaseCarbon;
use Carbon\CarbonImmutable as BaseCarbonImmutable;
use WPWhales\Support\Traits\Conditionable;
use WPWhales\Support\Traits\Dumpable;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Uid\Ulid;

class Carbon extends BaseCarbon
{
    use Conditionable, Dumpable;

    /**
     * {@inheritdoc}
     */
    public static function setTestNow($testNow = null)
    {
        BaseCarbon::setTestNow($testNow);
        BaseCarbonImmutable::setTestNow($testNow);
    }

    /**
     * Create a Carbon instance from a given ordered UUID or ULID.
     *
     * @param  \Ramsey\Uuid\Uuid|\Symfony\Component\Uid\Ulid|string  $id
     * @return \WPWhales\Support\Carbon
     */
    public static function createFromId($id)
    {
        return Ulid::isValid($id)
            ? static::createFromInterface(Ulid::fromString($id)->getDateTime())
            : static::createFromInterface(Uuid::fromString($id)->getDateTime());
    }
}
