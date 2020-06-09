<?php
declare(strict_types=1);

namespace Yiisoft\Yii\Queue\Synchronous\Tests;

use Yiisoft\Composer\Config\Builder;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Yiisoft\Di\Container;

abstract class TestCase extends BaseTestCase
{
    protected Container $container;

    protected function setUp(): void
    {
        $this->container = new Container(require Builder::path('tests-app'));
    }
}
