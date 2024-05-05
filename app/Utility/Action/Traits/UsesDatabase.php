<?php

namespace App\Utility\Action\Traits;

use Illuminate\Database\DatabaseManager;

/**
 * Trait UsesDatabase
 */
trait UsesDatabase
{
    /**
     * @var null|string
     */
    protected static ?string $transactionOwner = null;

    /**
     * @return \Illuminate\Database\DatabaseManager
     */
    protected function getDatabaseManager(): DatabaseManager
    {
        return app(DatabaseManager::class);
    }

    /**
     * Begin transaction
     * @throws \Throwable
     */
    protected function beginTransaction(): void
    {
        if ($this->hasLock()) {
            return;
        }
        $this->lock();
        $this->getDatabaseManager()->beginTransaction();
    }

    /**
     * Commit transaction
     * @throws \Throwable
     */
    protected function commit(): void
    {
        if ($this->isTransactionOwner()) {
            $this->getDatabaseManager()->commit();
            $this->unlock();
        }
    }

    /**
     * Rollback transaction
     * @throws \Throwable
     */
    protected function rollBack(): void
    {
        if ($this->isTransactionOwner()) {
            $this->getDatabaseManager()->rollBack();
            $this->unlock();
        }
    }

    /**
     * Check if transaction locked
     * @return bool
     */
    protected function hasLock(): bool
    {
        return !is_null(self::$transactionOwner);
    }

    /**
     * Lock transaction
     */
    protected function lock()
    {
        self::$transactionOwner = spl_object_hash($this);
    }

    /**
     * Unlock transaction
     */
    protected function unlock(): void
    {
        self::$transactionOwner = null;
    }

    /**
     * Is transaction owner
     * @return bool
     */
    protected function isTransactionOwner(): bool
    {
        return self::$transactionOwner === spl_object_hash($this);
    }

    /**
     * Before rollback hook
     */
    protected function beforeRollBack()
    {
        // Empty body
    }

    /**
     * Before commit hook
     */
    protected function beforeCommit()
    {
        // empty body
    }
}
