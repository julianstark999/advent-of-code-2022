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
    $requiredChars = 4;
    $buffer = str_split($data[0]);

    $unique = array_filter(
        array_map(
            fn (string $_, int $index): array => array_splice($buffer, $index, $requiredChars),
            $buffer,
            array_keys($buffer)
        ),
        fn (array $splice): bool => array_unique($splice) === $splice
    );

    $startIndex = array_keys($unique)[0] + $requiredChars;

    print_r("Challenge 1: {$startIndex}".PHP_EOL);
}

function challenge2(array $data): void
{
    $requiredChars = 14;
    $buffer = str_split($data[0]);

    $unique = array_filter(
        array_map(
            fn (string $_, int $index): array => array_splice($buffer, $index, $requiredChars),
            $buffer,
            array_keys($buffer)
        ),
        fn (array $splice): bool => array_unique($splice) === $splice
    );

    $startIndex = array_keys($unique)[0] + $requiredChars;

    print_r("Challenge 2: {$startIndex}".PHP_EOL);
}

$data = readData();
challenge1($data);
challenge2($data);
