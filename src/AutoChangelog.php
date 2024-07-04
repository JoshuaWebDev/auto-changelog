<?php

namespace JoshuaWebDev\AutoChangelog;

class AutoChangelog {
    protected $format = "\"%n%cs %n- %s (%h)\"";
    protected $logCommand = 'git log --decorate --tags --format=';
    protected $logFullCommand = 'git log --decorate --tags --abbrev-commit --date=short --no-expand-tabs';

    public function generate() {
        if (shell_exec($this->getGitLog()) == false || shell_exec($this->getGitLog()) == null) {
            echo "Não foi possível executar os comandos necessários para gerar os logs. Certifique-se de que possui o Git instalado e ao menos um commit.";
        } else {
            $this->setChangeLogFile();
        }
    }

    private function getGitLog() {
        return $this->logFullCommand;
    }

    private function createChangeLogFile() {
        echo shell_exec($this->getGitLog() . " > src/tmp/logs-to-changelog.md");
        echo "CHANGELOG.md foi criado com sucesso!";
    }

    private function handleFile($filename): array
    {
        if (is_null($filename)) {
            throw new Exception("O nome do arquivo está nulo (NULL)");
        }

        if (!file_exists($filename)) {
            throw new Exception("O arquivo {$filename} não existe ou encontra-se em outro local");
        }

        return file($filename);
    }
}
