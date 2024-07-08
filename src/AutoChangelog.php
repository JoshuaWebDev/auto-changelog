<?php

namespace JoshuaWebDev\AutoChangelog;

class AutoChangelog {
    protected $format = "\"%n%cs %n- %s (%h)\"";
    protected $logCommand = 'git log --decorate --format=';
    protected $logFullCommand = 'git log --decorate --abbrev-commit --date=short';

    function teste() {
        shell_exec($this->logCommand . $this->format . " > src/tmp/temp.md");
    }

    /**
     * Generate the CHANGELOG.md file
     *
     * @return void
     */
    public function generate(): void
    {
        if (shell_exec($this->getGitLog()) == false || shell_exec($this->getGitLog()) == null) {
            echo "The commands required to generate the logs could not be executed. Make sure you have Git installed and at least one commit.";
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
            echo shell_exec($this->getGitLog() . " > src/tmp/temp.md");
            
            $fileToArray = $this->handleFile('src/tmp/temp.md');

            // print_r($fileToArray);

            $output = "# Changelog\n\nAll notable changes to this project will be documented in this file.\n\nThe format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).\n\n## [Unreleased]\n\n";

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
                $commitCommented = "\n<!-- {$arrayCommits[$i][0]}{$arrayCommits[$i][1]}{$arrayCommits[$i][2]}{$arrayCommits[$i][3]}{$arrayCommits[$i][4]}{$arrayCommits[$i][5]}-->";
                $tagVersion = '';
                $dateCommit = $this->getDateFromCommit(trim($arrayCommits[$i][2]));
                $commitMessage = trim($arrayCommits[$i][4]);

                if ($this->tagExists($arrayCommits[$i][0])) {
                    $tagVersion = $this->getTagFromCommit($arrayCommits[$i][0]);
                    $tagVersion = '['. $tagVersion . '] - ' . $dateCommit;
                }
                
                $output .= !empty($tagVersion) ? "\n## $tagVersion\n\n - $commitMessage" : "\n- $commitMessage";
                $output .= $commitCommented;
            }

            if (file_put_contents("CHANGELOG.md", $output)) {
                echo "CHANGELOG.md file created successfully!";
            } else {
                echo "Unable to create CHANGELOG.md file!";
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
            throw new \Exception("The file name is null (NULL)");
        }

        if (!file_exists($filename)) {
            throw new \Exception("The file {$filename} does not exist or is located in another location");
        }

        return file($filename);
    }

    /**
     * Function to check if exists the word 'tag' in a string
     *
     * @param string $filename
     * @return bool
     */
    private function tagExists($text): bool
    {
        if (preg_match('/tag/', $text)) {
            return true;
        }
        return false;
    }

    /**
     * Search for a string like the pattern '(tag: v1.2.3)' and return only the substring 'v1.2.3'
     *
     * @param string $text
     * @return string
     */
    private function getTagFromCommit($text): string
    {
        preg_match('/tag.+\)/', $text, $matches);
        $tagVersion = '';

        if (count($matches) > 0) {
            $tagVersion = substr($matches[0], 6, -1);
        }

        return $tagVersion;        
    }

    /**
     * Return the date from a substring.
     * Example: 'Date    2010-10-20' -> '2010-10-20'
     *
     * @param string $text
     * @return string
     */
    private function getDateFromCommit($text) {
        return substr($text, -10);
    }
}
