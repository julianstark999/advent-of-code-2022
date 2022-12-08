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
    $currentPath = '';
    $directories = [''];
    $sizes = ['' => 0];

    foreach ($data as $line) {
        if ($line === '$ cd ..') {
            $currentPath = substr($currentPath, 0, strrpos($currentPath, '/'));
        } elseif (preg_match("/^\\$ cd ([^\/]*)$/", $line, $match)) {
            $currentPath = "{$currentPath}/{$match[1]}";
            $directories[] = $currentPath;
            $sizes[$currentPath] = 0;
        } elseif (preg_match("/(\d+) (.*)$/", $line, $match)) {
            $dirs = array_filter($directories, fn (string $directory): bool => str_starts_with("{$currentPath}/{$match[2]}", "{$directory}/"));
            foreach ($dirs as $directory) {
                $sizes[$directory] += intval($match[1]);
            }
        }
    }

    $sum = array_sum(array_filter($sizes, fn (int $size): bool => $size < 100000));

    print_r("Challenge 1: {$sum}".PHP_EOL);
}

function challenge2(array $data): void
{
    $currentPath = '';
    $directories = [''];
    $sizes = ['' => 0];

    foreach ($data as $line) {
        if ($line === '$ cd ..') {
            $currentPath = substr($currentPath, 0, strrpos($currentPath, '/'));
        } elseif (preg_match("/^\\$ cd ([^\/]*)$/", $line, $match)) {
            $currentPath = "{$currentPath}/{$match[1]}";
            $directories[] = $currentPath;
            $sizes[$currentPath] = 0;
        } elseif (preg_match("/(\d+) (.*)$/", $line, $match)) {
            $dirs = array_filter($directories, fn (string $directory): bool => str_starts_with("{$currentPath}/{$match[2]}", "{$directory}/"));
            foreach ($dirs as $directory) {
                $sizes[$directory] += intval($match[1]);
            }
        }
    }

    $freeSpace = 70_000_000 - $sizes[''];

    asort($sizes, SORT_NUMERIC);

    $sum = 0;
    foreach ($sizes as $size) {
        if ($freeSpace + $size > 30_000_000) {
            $sum = $size;
            break;
        }
    }

    print_r("Challenge 2: {$sum}".PHP_EOL);
}

$data = readData();
challenge1($data);
challenge2($data);
