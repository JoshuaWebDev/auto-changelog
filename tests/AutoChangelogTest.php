<?php

namespace JoshuaWebDev\AutoChangelog;

use JoshuaWebDev\AutoChangelog\AutoChangelog;
use JoshuaWebDev\AutoChangelog\TestCase;

class AutoChangelogTest extends TestCase
{
    private $autoChangelog;

    /**
    * @return void
    */
    protected function setUp(): void
    {
        $this->autoChangelog = new AutoChangelog();
        parent::setUp();
    }

    /**
     * @test
     * @return void
     */
    public function shouldBeInstanceOfClass(): void
    {
        $this->assertEquals('JoshuaWebDev\AutoChangelog\AutoChangelog', get_class($this->autoChangelog));
    }
}
