<?php
declare(strict_types=1);

class InfoPointure
{
    public function __construct(
        public readonly int $id_info_pointure,
        public readonly int $pointure,
        public readonly int $stock,
        public readonly int $id_chaussure,
    ) {}
}
