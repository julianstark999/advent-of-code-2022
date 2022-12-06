<?php

function readData(): array
{
    $fileHandle = fopen(dirname(__FILE__).'/input.txt', 'r');
    $data = [];

    while (($line = fgets($fileHandle)) !== false) {
        $data[] = trim($line);
    }
    fclose($fileHandle);

    return $data;
}

function challenge1(array $data): void
{
    $score = 0;

    foreach ($data as $line) {
        $score += [
            'X' => 1,
            'Y' => 2,
            'Z' => 3,
        ][substr($line, 2, 1)];

        $score += [
            'A X' => 3,
            'A Y' => 6,
            'A Z' => 0,
            'B X' => 0,
            'B Y' => 3,
            'B Z' => 6,
            'C X' => 6,
            'C Y' => 0,
            'C Z' => 3,
        ][$line];
    }

    print_r("Challenge 1: {$score}".PHP_EOL);
}

function challenge2(array $data): void
{
    $score = 0;

    foreach ($data as $line) {
        $input1 = ord(substr($line, 0, 1)) - ord('A');
        $input2 = ord(substr($line, 2, 1)) - ord('X');

        $score += ($input1 + ($input2 + 2) % 3) % 3 + 1 + 3 * $input2;
    }

    print_r("Challenge 2: {$score}".PHP_EOL);
}

$data = readData();
challenge1($data);
challenge2($data);
