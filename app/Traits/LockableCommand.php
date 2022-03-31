<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait LockableCommand
{
    protected bool $locked = false;

    /**
     * @return void
     */
    protected function lock(): void
    {
        $this->locked = true;
        Cache::put($this->lockKey, true, $this->lockTimeout);
    }

    /**
     * @return bool
     */
    protected function isLocked(): bool
    {
        return Cache::has($this->lockKey);
    }

    /**
     * @return void
     */
    protected function releaseLock(): void
    {
        $this->locked = false;
        Cache::forget($this->lockKey);
    }

    /**
     * @return void
     */
    protected function releaseIfLocked(): void
    {
        if ($this->locked) {
            $this->releaseLock();
        }
    }

    /**
     * @return array
     */
    public function getSubscribedSignals(): array
    {
        return [SIGINT];
    }

    /**
     * @param int $signal
     * @return void
     */
    public function handleSignal(int $signal): void
    {
        if ($signal === SIGINT) {
            $this->releaseIfLocked();
        }
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->releaseIfLocked();
    }
}
