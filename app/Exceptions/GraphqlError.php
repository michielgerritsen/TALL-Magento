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

namespace App\Exceptions;

use Throwable;

class GraphqlError extends \Exception
{
    public function __construct($data, $code = 0, Throwable $previous = null)
    {
        ['query' => $query, 'errors' => $errors] = $data;

        $errors = collect($errors);

        $message = $errors->pluck('message')->join(PHP_EOL);
        $message .= 'Query:' . PHP_EOL . $query;

        parent::__construct($message, $code, $previous);
    }

}
