<?php

namespace App\Services\Block;

use App\Repositories\BlockRepository;

class BlockService
{
    public function __construct(private BlockRepository $blockRepository)
    {
    }

    public function list() {
        return $this->blockRepository->list();
    }
}
