<?php

declare(strict_types=1);


use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use RectorLaravel\Set\LaravelLevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->sets([
        LaravelLevelSetList::UP_TO_LARAVEL_100,
        LevelSetList::UP_TO_PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
    ]);

    $rectorConfig->rules([
        // ...
    ]);

    // https://getrector.com/documentation/ignoring-rules-or-paths
    $rectorConfig->skip([
        // ...
    ]);
};
