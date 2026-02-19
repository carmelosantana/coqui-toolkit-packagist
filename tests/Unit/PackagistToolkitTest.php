<?php

declare(strict_types=1);

use CoquiBot\Toolkits\Packagist\PackagistToolkit;

test('toolkit implements ToolkitInterface', function () {
    $toolkit = new PackagistToolkit();

    expect($toolkit)->toBeInstanceOf(\CarmeloSantana\PHPAgents\Contract\ToolkitInterface::class);
});

test('tools returns packagist tool', function () {
    $toolkit = new PackagistToolkit();
    $tools = $toolkit->tools();

    expect($tools)->toHaveCount(1);
    expect($tools[0]->name())->toBe('packagist');
});

test('guidelines returns non-empty string', function () {
    $toolkit = new PackagistToolkit();

    expect($toolkit->guidelines())->toBeString()->not->toBeEmpty();
});

test('fromEnv creates instance', function () {
    $toolkit = PackagistToolkit::fromEnv();

    expect($toolkit)->toBeInstanceOf(PackagistToolkit::class);
});
