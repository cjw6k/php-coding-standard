<?php

namespace Tests;

use DirectoryIterator;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function dirname;
use function json_decode;
use function ksort;
use function print_r;
use function shell_exec;

class RuleTest extends TestCase
{
    #[Test]
    #[DataProvider('allActiveRules')]
    public function it_sniffs_out_the_not_good_code(string $rule, string $path): void
    {
        $resultJson = shell_exec(
            __DIR__ . "/../vendor/bin/phpcs --standard=cjw6k/ruleset.xml --report=json $path 2>/dev/null"
        );
        $result = json_decode($resultJson);
        $this->assertGreaterThan(0, $result->totals->errors + $result->totals->warnings, 'the rule did not report');

        foreach ($result->files->$path->messages as $message) {
            $this->assertStringStartsWith(
                $rule,
                $message->source,
                print_r($result->files->$path->messages, true)
            );
        }
    }

    public static function allActiveRules(): Generator
    {
        $dir = new DirectoryIterator(dirname(__FILE__) . '/Fixtures');

        $data = [];

        foreach ($dir as $fileInfo) {
            if (
                $fileInfo->isDot()
                || ! $fileInfo->isFile()
                || $fileInfo->getExtension() !== 'php'
            ) {
                continue;
            }

            $rule = $fileInfo->getBasename('.php');

            $data[$rule] = [$rule, $fileInfo->getRealPath()];
        }

        ksort($data);

        foreach ($data as $key => $datum) {
            yield $key => $datum;
        }
    }
}
