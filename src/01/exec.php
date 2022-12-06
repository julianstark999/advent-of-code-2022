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
    $groups = [];
    $i = 1;

    foreach ($data as $line) {
        if (! strlen($line)) {
            $i++;

            continue;
        }

        if (array_key_exists($i, $groups)) {
            $groups[$i] += (int) $line;
        } else {
            $groups[$i] = (int) $line;
        }
    }

    print_r('Challenge 1: '.max($groups).PHP_EOL);
}

function challenge2(array $data): void
{
    $groups = [];
    $i = 1;

    foreach ($data as $line) {
        if (! strlen($line)) {
            $i++;

            continue;
        }

        if (array_key_exists($i, $groups)) {
            $groups[$i] += (int) $line;
        } else {
            $groups[$i] = (int) $line;
        }
    }

    // sort array desc
    usort($groups, fn (int $a, int $b): int => $a < $b ? 1 : -1);

    // short array to 3 items
    $groups = array_slice($groups, 0, 3);
    // sum items
    $sum = array_sum($groups);

    print_r('Challenge 2: '.$sum.PHP_EOL);
}

$data = readData();
challenge1($data);
challenge2($data);
