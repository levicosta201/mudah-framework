<?php
declare(strict_types=1);

namespace Core\Kernel;

interface IRequest
{
    public function getBody();
}