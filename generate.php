<?php

namespace JoshuaWebDev\AutoChangelog;

require_once 'vendor/autoload.php';

$changelog = new AutoChangelog();

$changelog->generate();

// if (shell_exec($obj->getGitLog()) == false || shell_exec($obj->getGitLog()) == null) {
//   echo 'Não foi possível executar o comando para geração dos logs. Certifique-se de que possui o Git instalado e tenha efetuado ao menos um commit.';
// } else {
//   echo shell_exec($obj->getGitLog() . " > CHANGELOG.md");
// }

// shell_exec($obj->getGitLog() . " > CHANGELOG.md");
