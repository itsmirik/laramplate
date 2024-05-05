<?php

namespace App\Utility\Action\Contracts;

/**
 * Interface CoreAction
 * @package Sigma\Core\Actions\Contracts
 */
interface CoreAction
{
    /**
     * Execute action
     * @param array $params
     * @return mixed
     */
    public function execute(...$params);
}
