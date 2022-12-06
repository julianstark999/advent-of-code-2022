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
    $sum = 0;

    foreach ($data as $line) {
        $first = substr($line, 0, strlen($line) / 2);
        $second = substr($line, (strlen($line) / 2));

        $letter = implode(
            array_unique(
                array_intersect(
                    str_split($first),
                    str_split($second)
                )
            )
        );

        $sum += ord($letter) - (ctype_upper($letter) ? 38 : 96);
    }

    print_r("Challenge 1: {$sum}".PHP_EOL);
}

function challenge2(array $data): void
{
    $sum = 0;

    for ($i = 0; $i < count($data) / 3; $i++) {
        $first = $data[$i * 3];
        $second = $data[($i * 3) + 1];
        $third = $data[($i * 3) + 2];

        $letter = implode(
            array_unique(
                array_intersect(
                    str_split($first),
                    str_split($second),
                    str_split($third)
                )
            )
        );

        $sum += ord($letter) - (ctype_upper($letter) ? 38 : 96);
    }

    print_r("Challenge 2: {$sum}".PHP_EOL);
}

$data = readData();
challenge1($data);
challenge2($data);
