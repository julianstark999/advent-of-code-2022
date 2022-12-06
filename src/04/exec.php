<?php

function readData(): array
{
    $fileHandle = fopen(dirname(__FILE__).'/input.txt', 'r');
    $data = [];

    while (($line = fgets($fileHandle)) !== false) {
        $data[] = trim($line);
    }
    fclose($fileHandle);

    $data = array_map(
        fn (string $section): array => array_map(
            fn (string $range): array => mb_split('-', $range),
            mb_split(',', $section)
        ),
        $data
    );

    return $data;
}

function challenge1(array $data): void
{
    $sum = 0;

    foreach ($data as [[$a, $b], [$c, $d]]) {
        if (
            ($a <= $c && $b >= $d)
            || ($c <= $a && $d >= $b)
        ) {
            $sum++;
        }
    }

    print_r("Challenge 1: {$sum}".PHP_EOL);
}

function challenge2(array $data): void
{
    $sum = 0;

    foreach ($data as [[$a, $b], [$c, $d]]) {
        if (
            ($a <= $c && $b >= $c)
            || ($c <= $a && $d >= $a)
        ) {
            $sum++;
        }
    }

    print_r("Challenge 2: {$sum}".PHP_EOL);
}

$data = readData();
challenge1($data);
challenge2($data);
