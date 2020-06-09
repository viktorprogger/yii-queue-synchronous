<?php
declare(strict_types=1);

namespace Yiisoft\Yii\Queue\Synchronous\Tests\App;

use Throwable;
use Yiisoft\Yii\Queue\Job\RetryableJobInterface;

class RetryableJob extends SimpleJob implements RetryableJobInterface
{
    protected int $attemptsMax;
    protected int $attempt;

    public function __construct(int $attemptsMax = 1, int $attempt = 1)
    {
        $this->attemptsMax = $attemptsMax;
        $this->attempt = $attempt;
    }

    public function canRetry(?Throwable $error = null): bool
    {
        return $this->attemptsMax > $this->attempt;
    }

    public function retry(): void
    {
        $this->attempt++;
    }

    public function getTtr(): int
    {
        return 1;
    }
}
