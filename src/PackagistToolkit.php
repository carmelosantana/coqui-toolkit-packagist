<?php

declare(strict_types=1);

namespace CoquiBot\Toolkits\Packagist;

use CarmeloSantana\PHPAgents\Contract\ToolkitInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Toolkit providing Packagist package discovery and evaluation tools.
 *
 * Auto-discovered by Coqui's ToolkitDiscovery when installed via Composer.
 * All Packagist API endpoints are anonymous — no credentials required.
 */
final class PackagistToolkit implements ToolkitInterface
{
    private readonly HttpClientInterface $httpClient;

    public function __construct(
        ?HttpClientInterface $httpClient = null,
    ) {
        $this->httpClient = $httpClient ?? HttpClient::create([
            'headers' => [
                'User-Agent' => 'Coqui/1.0 (https://github.com/AgentCoqui/coqui)',
            ],
        ]);
    }

    /**
     * Factory method for ToolkitDiscovery — no credentials needed.
     */
    public static function fromEnv(): self
    {
        return new self();
    }

    public function tools(): array
    {
        return [
            new PackagistTool(httpClient: $this->httpClient),
        ];
    }

    public function guidelines(): string
    {
        return <<<'GUIDELINES'
            <PACKAGIST-TOOLKIT-GUIDELINES>
            Use the `packagist` tool to discover and evaluate PHP packages before installing.

            Recommended workflow:
            1. `packagist` search → find candidate packages
            2. `packagist` details → evaluate downloads, maintainers, freshness
            3. `packagist` advisories → check for known vulnerabilities
            4. `composer` require → install the vetted package

            Available actions: search, popular, details, stats, versions, advisories

            All endpoints are anonymous — no authentication required.
            </PACKAGIST-TOOLKIT-GUIDELINES>
            GUIDELINES;
    }
}
