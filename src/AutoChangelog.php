<?php
namespace JoshuaWebDev\AutoChangelog;

class AutoChangelog {
    protected $format = "\"%n%cs %n- %s (%h)\"";
    protected $logCommand = 'git log --decorate --tags --format=';
    //protected $logFullCommand = 'git log --decorate --tags';
    protected $logFullCommand = 'git log --decorate --tags --abbrev-commit --date=short --no-expand-tabs';

    public function getGitLog() {
        return $this->logFullCommand;
    }
}
