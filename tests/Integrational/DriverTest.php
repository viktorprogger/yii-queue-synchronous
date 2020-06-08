<?php
declare(strict_types=1);

namespace Yiisoft\Yii\Queue\Driver\Tests\Integrational;

use Yiisoft\Yii\Queue\Driver\Tests\App\DelayableJob;
use Yiisoft\Yii\Queue\Driver\Tests\App\PrioritizedJob;
use Yiisoft\Yii\Queue\Driver\Tests\App\RetryableJob;
use Yiisoft\Yii\Queue\Driver\Tests\App\SimpleJob;
use Yiisoft\Yii\Queue\Driver\Tests\TestCase;
use Yiisoft\Yii\Queue\Exception\JobNotSupportedException;
use Yiisoft\Yii\Queue\Job\DelayableJobInterface;
use Yiisoft\Yii\Queue\Job\PrioritisedJobInterface;
use Yiisoft\Yii\Queue\Job\RetryableJobInterface;
use Yiisoft\Yii\Queue\Queue;

class DriverTest extends TestCase
{
    /**
     * @dataProvider getJobTypes
     *
     * @param string $class
     * @param bool $available
     */
    public function testJobType(string $class, bool $available): void
    {
        $queue = $this->container->get(Queue::class);
        $job = $this->container->get($class);

        if (!$available) {
            $this->expectException(JobNotSupportedException::class);
        }

        $id = $queue->push($job);

        if ($available) {
            $this->assertTrue($id > 0);
        }
    }

    public static function getJobTypes(): array
    {
        return [
            'Simple job' => [
                SimpleJob::class,
                true,
            ],
            DelayableJobInterface::class => [
                DelayableJob::class,
                false,
            ],
            PrioritisedJobInterface::class => [
                PrioritizedJob::class,
                false,
            ],
            RetryableJobInterface::class => [
                RetryableJob::class,
                true,
            ],
        ];
    }
}
