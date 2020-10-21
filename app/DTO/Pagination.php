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

namespace App\DTO;

use Illuminate\Pagination\LengthAwarePaginator;

class Pagination
{
    /**
     * @var int
     */
    private $totalCount;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int
     */
    private $pageSize;

    /**
     * @var int
     */
    private $totalPages;

    public function __construct(
        int $totalCount,
        int $currentPage,
        int $pageSize,
        int $totalPages
    ) {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->pageSize = $pageSize;
        $this->totalCount = $totalCount;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getPaginator()
    {
        return new LengthAwarePaginator(
            [],
            $this->getTotalCount(),
            $this->getPageSize(),
            $this->getCurrentPage()
        );
    }
}
