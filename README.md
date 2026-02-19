# Coqui Packagist Toolkit

Packagist package discovery toolkit for [Coqui](https://github.com/AgentCoqui/coqui). Provides search, evaluation, and security advisory lookup tools that agents can use to find and vet PHP packages before installing.

## Requirements

- PHP 8.4+
- `symfony/http-client`

## Installation

```bash
composer require coquibot/coqui-toolkit-packagist
```

When installed alongside Coqui, the toolkit is **auto-discovered** via Composer's `extra.php-agents.toolkits` — no manual registration needed.

## Tools Provided

### `packagist`

Search and explore packages on Packagist.org.

| Parameter  | Type    | Required | Description                                     |
|------------|---------|----------|-------------------------------------------------|
| `action`   | enum    | Yes      | `search`, `popular`, `details`, `stats`, `versions`, `advisories` |
| `query`    | string  | No       | Search keywords (required for search)            |
| `package`  | string  | No       | Full package name (required for details/stats/versions/advisories) |
| `tags`     | string  | No       | Filter by tag (search only)                      |
| `type`     | string  | No       | Filter by package type (search only)             |
| `page`     | integer | No       | Page number for pagination                       |
| `per_page` | integer | No       | Results per page (1-100, default 15)             |

All Packagist endpoints are anonymous — no authentication or API keys required.

## Standalone Usage

```php
<?php

declare(strict_types=1);

use CoquiBot\Toolkits\Packagist\PackagistToolkit;

require __DIR__ . '/vendor/autoload.php';

$toolkit = PackagistToolkit::fromEnv();

foreach ($toolkit->tools() as $tool) {
    echo $tool->name() . ': ' . $tool->description() . PHP_EOL;
}

// Search for packages
$result = $toolkit->tools()[0]->execute([
    'action' => 'search',
    'query' => 'http client',
]);
echo $result->content;
```

## Development

```bash
git clone https://github.com/AgentCoqui/coqui-toolkit-packagist.git
cd coqui-toolkit-packagist
composer install
```

### Run tests

```bash
./vendor/bin/pest
```

### Static analysis

```bash
./vendor/bin/phpstan analyse
```

## License

MIT
