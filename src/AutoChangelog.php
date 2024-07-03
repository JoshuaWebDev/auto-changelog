<?php
namespace JoshuaWebDev\AutoChangelog;

class AutoChangelog {
    private $logCommand = "git log";

    public function teste() {
        echo "tudo certo!";
    }

    public function getGitLog() {
        return $this->logCommand;
    }
}
