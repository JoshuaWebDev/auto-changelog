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
    public function should_be_instance_of_class(): void
    {
        $this->assertEquals('JoshuaWebDev\AutoChangelog\AutoChangelog', get_class($this->autoChangelog));
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_tmp_directory(): void
    {
        $tmpdir = 'src/tmp/logs-to-changelog.md';
        $this->assertTrue(file_exists($tmpdir));
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_generate_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'generate'));
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_getGitLog_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'getGitLog'));
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_createChangeLogFile_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'createChangeLogFile'));
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_handleFile_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'handleFile'));
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_the_public_methods_of_the_list(): void
    {
        $list = ['generate'];
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertEquals($list, $methods);
    }

    /**
     * @test
     * @return void
     */
    public function the_getGitLog_method_must_be_private(): void
    {
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertFalse(in_array('getGitLog', $methods));
    }

    /**
     * @test
     * @return void
     */
    public function the_createChangeLogFile_method_must_be_private(): void
    {
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertFalse(in_array('createChangeLogFile', $methods));
    }
}
