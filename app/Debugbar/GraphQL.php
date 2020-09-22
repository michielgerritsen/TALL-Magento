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

namespace App\Debugbar;

use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\Renderable;

class GraphQL extends DataCollector implements Renderable
{
    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var array
     */
    private $data = [];

    public function getName()
    {
        return 'graphql';
    }

    public function addQuery(string $query, array $result)
    {
        $this->count++;
        $name = $this->generateName($result);

        $this->data[$name] = $this->formatVar([
            'query' => $query,
            'result' => $result,
        ]);
    }

    private function generateName($result)
    {
        $name = [];
        $data = $result;
        for ($i = 0; $i < 2; $i++) {
            if (!is_array($data)) {
                break;
            }

            $keys = array_keys($data);
            $key = array_shift($keys);

            $name[] = $key;

            if (!isset($data[$key])) {
                break;
            }

            $data = $data[$key];
        }

        return implode('.', $name) . '#' . (count($this->data) + 1);
    }

    function collect()
    {
        return [
            'data' => $this->data,
            'count' => $this->count,
        ];
    }

    public function getWidgets()
    {
        return [
            'graphql' => [
                'icon' => 'cogs',
                'map' => 'graphql.data',
                'default' => '{}',
                'widget' => 'PhpDebugBar.Widgets.VariableListWidget',
            ],
            'graphql:badge' => [
                'map' => 'graphql.count',
                'default' => 0,
            ],
        ];
    }
}
