<?php
declare(strict_types=1);

use Yiisoft\Yii\Queue\Synchronous\SynchronousDriver;
use Yiisoft\Yii\Queue\DriverInterface;

return [
    DriverInterface::class => SynchronousDriver::class,
];
