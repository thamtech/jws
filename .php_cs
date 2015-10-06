<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__);

return Symfony\CS\Config\Config::create()
    ->fixers([
        '-whitespacy_lines',
        '-phpdoc_separation',
        '-blankline_after_open_tag',
      ])
    ->finder($finder);