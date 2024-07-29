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
    public function should_exist_temp_file(): void
    {
        $tempFile = 'src/tmp/temp.md';
        $this->assertTrue(file_exists($tempFile), 'The temp.md does not exist');
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_generate_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'generate'), 'The method generate does not exist');
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_getGitLog_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'getGitLog'), 'The method getGitLog does not exist');
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_createChangeLogFile_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'createChangeLogFile'), 'The method createChangeLogFile does not exist');
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_handleFile_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'handleFile'), 'The method handleFile does not exist');
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_tagExists_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'tagExists'), 'The method tagExists does not exist');
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_getTagFromCommit_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'getTagFromCommit'), 'The method getTagFromCommit does not exist');
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_getDateFromCommit_method(): void
    {
        $obj = new AutoChangelog();
        $this->assertTrue(method_exists($obj, 'getDateFromCommit'), 'The method getDateFromCommit does not exist');
    }

    /**
     * @test
     * @return void
     */
    public function should_exist_the_public_methods_of_the_list(): void
    {
        $list = ['teste', 'generate'];
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertEquals($list, $methods);
    }

    /**
     * @test
     * @return void
     */
    public function the_method_getGitLog_must_be_private(): void
    {
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertFalse(in_array('getGitLog', $methods), 'The method getGitLog is public but must be private');
    }

    /**
     * @test
     * @return void
     */
    public function the_method_createChangeLogFile_must_be_private(): void
    {
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertFalse(in_array('createChangeLogFile', $methods), 'The method createChangeLogFile is public but must be private');
    }

    /**
     * @test
     * @return void
     */
    public function the_method_tagExists_must_be_private(): void
    {
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertFalse(in_array('tagExists', $methods), 'The method tagExists is public but must be private');
    }

    /**
     * @test
     * @return void
     */
    public function the_method_getTagFromCommit_must_be_private(): void
    {
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertFalse(in_array('getTagFromCommit', $methods), 'The method getTagFromCommit is public but must be private');
    }

    /**
     * @test
     * @return void
     */
    public function the_method_getDateFromCommit_must_be_private(): void
    {
        $obj = new AutoChangelog();
        $methods = get_class_methods($obj);
        $this->assertFalse(in_array('getDateFromCommit', $methods), 'The method getDateFromCommit is public but must be private');
    }
}
