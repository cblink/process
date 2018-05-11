<?php


namespace Cblink\Process;


use Illuminate\Support\Facades\Cache;

class Process
{

    private $cachePrefix = 'cblink.process.';

    private $processName;

    protected $total;

    private $minutes;

    public function __construct($name, $minutes = 60, $total = 100)
    {
        $this->processName = $name;
        $this->total = $total;
        $this->minutes = $minutes;
    }

    /**
     * cache current process
     *
     * @param int $current
     */
    private function cache($current = 0)
    {
        $process = Cache::get($this->cachePrefix . $this->processName);

        if ($process && $process['current']) {
            $current += $process['current'];
        }

        Cache::put($this->cachePrefix . $this->processName, [
            'total' => $this->total,
            'current' => $current
        ], $this->minutes);
    }

    /**
     * return process in cache
     *
     * @return mixed
     */
    public function getProcess()
    {
        return Cache::get($this->cachePrefix . $this->processName);
    }

    public function start()
    {
        $this->cache();
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;

        $this->cache();
    }

    /**
     * add process
     *
     * @param int $num
     */
    public function add($num = 1)
    {
        $this->cache($num);
    }

    /**
     * reset process
     */
    public function reset()
    {
        Cache::put($this->cachePrefix . $this->processName, [
            'total' => $this->total,
            'current' => 0
        ], $this->minutes);
    }

    /**
     * flush the process
     */
    public function flush()
    {
        Cache::forget($this->cachePrefix . $this->processName);
    }

}