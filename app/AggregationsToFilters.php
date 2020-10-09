<?php
/**
 *    ______            __             __
 *   / ____/___  ____  / /__________  / /
 *  / /   / __ \/ __ \/ __/ ___/ __ \/ /
 * / /___/ /_/ / / / / /_/ /  / /_/ / /
 * \______________/_/\__/_/   \____/_/
 *    /   |  / / /_
 *   / /| | / / __/
 *  / ___ |/ / /_
 * /_/ _|||_/\__/ __     __
 *    / __ \___  / /__  / /____
 *   / / / / _ \/ / _ \/ __/ _ \
 *  / /_/ /  __/ /  __/ /_/  __/
 * /_____/\___/_/\___/\__/\___/
 *
 */

namespace App;

class AggregationsToFilters
{
    /**
     * @var array
     */
    private $queryDefinitions = [];

    /**
     * @var array
     */
    private $filterDefinitions = [];

    /**
     * @var array
     */
    private $variables = [];

    public function __construct(
        array $aggregations
    ) {
        foreach ($aggregations as $code => $value) {
            $this->processQueryDefinition($code, $value);
            $this->processFilterDefinition($code, $value);
            $this->processVariables($code, $value);
        }
    }

    public function getCacheKey()
    {
        return md5(json_encode($this->variables));
    }

    private function processQueryDefinition(string $code, string $value): void
    {
        if ($code != 'price') {
            $this->queryDefinitions[] = '$' . $code . ':String!';
            return;
        }

        $this->queryDefinitions[] = '$priceFrom:String!';

        [, $priceTo] = explode('_', $value);
        if ($priceTo != '*') {
            $this->queryDefinitions[] = '$priceTo:String!';
        }
    }

    private function processFilterDefinition(string $code, string $value): void
    {
        if ($code != 'price') {
            $this->filterDefinitions[] = $code . ':{eq:$' . $code . '}';
            return;
        }

        [, $priceTo] = explode('_', $value);
        if ($priceTo == '*') {
            $this->filterDefinitions[] = $code . ':{from:$priceFrom}';
            return;
        }

        $this->filterDefinitions[] = $code . ':{from:$priceFrom,to:$priceTo}';
    }

    private function processVariables(string $code, string $value): void
    {
        if ($code == 'price') {
            [$priceFrom, $priceTo] = explode('_', $value);

            $this->variables['priceFrom'] = $priceFrom;

            if ($priceTo != '*') {
                $this->variables['priceTo'] = $priceTo;
            }

            return;
        }

        $this->variables[$code] = $value;
    }

    public function getQueryDefinition(): string
    {
        return implode(',', $this->queryDefinitions);
    }

    public function getFilterDefinition(): string
    {
        return '{' . implode(',', $this->filterDefinitions) . '}';
    }

    public function getVariables(): array
    {
        return $this->variables;
    }
}
