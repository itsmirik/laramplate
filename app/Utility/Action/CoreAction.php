<?php

namespace App\Utility\Action;


use App\Exceptions\MethodNotImplementedException;
use App\Utility\Action\Contracts\CoreAction as CoreActionContract;
use App\Utility\Action\Traits\UsesDatabase;
use Throwable;

/**
 * Class CoreAction
 * @package App\Actions\Core
 */
class CoreAction implements CoreActionContract
{
    use UsesDatabase;

    /**
     * Should our action use transactions
     * @var bool
     */
    protected bool $useTransactions = true;

    /**
     * Handle action
     * @param array $params
     * @return mixed
     * @throws \Throwable
     */
    public function execute(...$params): mixed
    {
        try {
            $this->useTransactions && $this->beginTransaction();

            if (!method_exists($this, 'handle')) {
                throw new MethodNotImplementedException('Method "handle" does not exist in: ' . get_class($this));
            }

            $result = $this->handle(...$params);
        } catch (Throwable $e) {
            $this->processFailure($e);
        }

        $this->beforeCommit();
        if ($this->useTransactions) {
            $this->commit();
        }

        if (method_exists($this, 'afterCoreActionCommit')) {
            $this->afterCoreActionCommit(...$params);
        }

        return $result;
    }

    /**
     * @param \Throwable $e
     * @throws \Throwable
     */
    private function processFailure(Throwable $e)
    {
        $this->beforeRollBack();
        $this->useTransactions && $this->rollBack();

        throw $e;
    }
}
