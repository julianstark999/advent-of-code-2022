<?php

function readData(): array
{
    $fileHandle = fopen(dirname(__FILE__).'/input.txt', 'r');
    $data = [];

    $i = 0;
    $instructionsStart = 0;
    while (($line = fgets($fileHandle)) !== false) {
        $data[] = $line;

        if (strlen(trim($line)) === 0) {
            $instructionsStart = $i;
        }

        $i++;
    }
    fclose($fileHandle);

    $preparedData = [];
    $stackCount = max(preg_split('/\s+/', trim($data[$instructionsStart - 1])));
    $stacks = [];

    for ($i = 0; $i < $stackCount; $i++) {
        for ($j = 0; $j < $instructionsStart - 1; $j++) {
            $crate = trim(substr($data[$j], $i > 0 ? (3 * $i) + ($i) : 0, 3));
            if (strlen($crate)) {
                $stacks[$i][] = $crate;
            }
        }
    }

    $preparedData['stacks'] = $stacks;
    $preparedData['instructions'] = array_map(fn (string $line): string => trim($line), array_slice($data, $instructionsStart + 1));

    return $preparedData;
}

function challenge1(array $data): void
{
    $stacks = $data['stacks'];
    $instructions = $data['instructions'];

    foreach ($instructions as $instruction) {
        preg_match('/(move\s)\K\d+/', $instruction, $move);
        $move = $move[0];
        preg_match('/(from\s)\K\d+/', $instruction, $from);
        $from = $from[0];
        preg_match('/(to\s)\K\d+/', $instruction, $to);
        $to = $to[0];

        for ($i = 0; $i < $move; $i++) {
            $crate = array_shift($stacks[$from - 1]);
            array_unshift($stacks[$to - 1], $crate);
        }
    }

    $topLevel = str_replace(['[', ']'], '', implode(array_map(fn (array $stack): string => $stack[0], $stacks)));

    print_r("Challenge 1: {$topLevel}".PHP_EOL);
}

function challenge2(array $data): void
{
    $stacks = $data['stacks'];
    $instructions = $data['instructions'];

    foreach ($instructions as $instruction) {
        preg_match('/(move\s)\K\d+/', $instruction, $move);
        $move = $move[0];
        preg_match('/(from\s)\K\d+/', $instruction, $from);
        $from = $from[0];
        preg_match('/(to\s)\K\d+/', $instruction, $to);
        $to = $to[0];

        $crates = array_slice($stacks[$from - 1], 0, $move);
        array_splice($stacks[$from - 1], 0, $move);
        $stacks[$to - 1] = array_merge($crates, $stacks[$to - 1]);
    }

    $topLevel = str_replace(['[', ']'], '', implode(array_map(fn (array $stack): string => $stack[0] ?? '', $stacks)));

    print_r("Challenge 2: {$topLevel}".PHP_EOL);
}

$data = readData();
challenge1($data);
challenge2($data);
