<?php
declare(strict_types=1);

namespace Yiisoft\Yii\Queue\Synchronous\Tests\App;

use Yiisoft\Yii\Queue\Job\DelayableJobInterface;

class DelayableJob extends SimpleJob implements DelayableJobInterface
{
    public function getDelay(): int
    {
        return 1;
    }
}
