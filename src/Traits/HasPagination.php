<?php

namespace Arkitecht\LaravelHume\Traits;

trait HasPagination
{
    protected int $pageNumber;
    protected int $pageSize;
    protected int $totalPages;

    protected ?string $paginationDirection;

    public function page()
    {
        return $this->pageNumber;
    }

    public function pageSize()
    {
        return $this->pageSize;
    }

    public function totalPages()
    {
        return $this->totalPages;
    }
}
