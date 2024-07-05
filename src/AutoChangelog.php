<?php

namespace JoshuaWebDev\AutoChangelog;

class AutoChangelog {
    protected $format = "\"%n%cs %n- %s (%h)\"";
    protected $logCommand = 'git log --decorate --tags --format=';
    protected $logFullCommand = 'git log --decorate --tags --abbrev-commit --date=short --no-expand-tabs';

    /**
     * Generate the CHANGELOG.md file
     *
     * @return void
     */
    public function generate(): void
    {
        if (shell_exec($this->getGitLog()) == false || shell_exec($this->getGitLog()) == null) {
            echo "Não foi possível executar os comandos necessários para gerar os logs. Certifique-se de que possui o Git instalado e ao menos um commit.";
        } else {
            $this->createChangeLogFile();
        }
    }

    /**
     * Function to generate the Git log command
     *
     * @return string
     */
    private function getGitLog(): string
    {
        return $this->logFullCommand;
    }

    /**
     * Function to create the file CHANGELOG.md
     *
     * @param string $filename
     * @return void 
     */
    private function createChangeLogFile(): void
    {
        try {
            // Execute git log command e write the output to temporary file (logs-to-changelog.md)
            echo shell_exec($this->getGitLog() . " > src/tmp/logs-to-changelog.md");
            
            $fileToArray = $this->handleFile('src/tmp/logs-to-changelog.md');

            // print_r($fileToArray);

            $output = "# Changelog\n\nAll notable changes to this project will be documented in this file.\n\nThe format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).\n";

            $arrayCommits = [];
            $arrayTemp = [];

            $count = 5;

            foreach ($fileToArray as $key => $value) {
                //echo $key . " | " . $value;

                if ($key <= $count) {
                    array_push($arrayTemp, $value);
                }

                if ($key == $count) {
                    array_push($arrayCommits, $arrayTemp);
                    $arrayTemp = [];
                    $count += 6;

                }
            }

            //print_r($arrayCommits);

            for ($i = 0; $i < count($arrayCommits); $i++) {
                for ($j = 0; $j < 6; $j++) {
                    //$output .= "# {$values[0]}<!-- {$values[1]} -->{$values[2]}\n - {$values[4]}\n";
                    //$output .= "# {$values[$key][0]}<!-- {$values[$key][1]} -->{$values[$key][2]}\n - {$values[$key][4]}\n";
                    //$output .= $values[0] . "\n";
                    $output .= "## [{$arrayCommits[$i][0]}] <!-- {$arrayCommits[$i][1]} --> - {$arrayCommits[$i][2]} \n- {$arrayCommits[$i][4]}\n";
                }
                //$output .= "\n--------------------------------------------------------------------------------\n";
                //var_dump($values);
            }

            if (file_put_contents("src/tmp/temp.md", $output)) {
                echo "Arquivo CHANGELOG.md criado com sucesso!";
            } else {
                echo "Não foi possível criar o arquivo!";
            }

        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }

    /**
     * Function to check if is possible to create a file
     *
     * @param string $filename
     * @return array
     */
    private function handleFile($filename): array
    {
        if (is_null($filename)) {
            throw new \Exception("O nome do arquivo está nulo (NULL)");
        }

        if (!file_exists($filename)) {
            throw new \Exception("O arquivo {$filename} não existe ou encontra-se em outro local");
        }

        return file($filename);
    }
}
