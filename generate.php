<?php

namespace JoshuaWebDev\AutoChangelog;

require_once 'vendor/autoload.php';

$obj = new AutoChangelog();

shell_exec($obj->getGitLog() . " > CHANGELOG.md");
