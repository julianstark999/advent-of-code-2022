<?php

/**
 * Inspired by Tyson Jouglet (https://github.com/TysonJouglet) with his "aoc PL/SQL Package" (https://gist.github.com/TysonJouglet/fefffe3ee4e874aeab2e42b2b1649f28).
 *
 * A new Advent of Code session value is needed. Please do the following:
 * 1) Log into your account at https://adventofcode.com
 * 2) Open dev tools and view page cookies
 * 3) Look at the session cookie and copy the value
 * 4) Replace "<your session>" with the newly copied value
 */
$session = '<your session>';

$input = file_get_contents(
    sprintf('https://adventofcode.com/%d/day/%d/input', date('Y'), date('j')),
    false,
    stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => 'Cookie: session='.$session."\r\n",
        ],
    ])
);

print_r($input);
