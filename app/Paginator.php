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

class Paginator
{
    /**
     * @var int
     */
    private $pageSize;

    /**
     * @var int
     */
    private $currentPage;

    public function __construct(
        int $pageSize,
        int $currentPage
    ) {
        $this->pageSize = $pageSize;
        $this->currentPage = $currentPage;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }
}
