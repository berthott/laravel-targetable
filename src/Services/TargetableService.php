<?php

namespace berthott\Targetable\Services;

use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

abstract class TargetableService
{
    /**
     * The key for caching the targetables.
     */
    private string $cacheKey;

    /**
     * The name of the Laravel config file.
     */
    private string $configKey;

    /**
     * The trait that should be targeted.
     */
    private string $targetTrait;

    /**
     * Collection with all targetable classes.
     */
    private Collection $targetables;

    /**
     * The Constructor.
     */
    public function __construct(string $targetTrait, string $configKey)
    {
        $this->targetTrait = $targetTrait;
        $this->configKey = $configKey;
        $this->cacheKey = get_class($this).'-Cache-Key';
        $this->initTargetableClasses();
    }

    /**
     * Get the crudable classes collection.
     */
    public function getTargetableClasses(): Collection
    {
        return $this->targetables;
    }

    /**
     * Initialize the targetable classes collection.
     */
    private function initTargetableClasses(): void
    {
        $this->targetables = Cache::sear($this->cacheKey, function () {
            $targetables = [];
            $namespaces = config($this->configKey.'.namespace', 'App\Models');
            foreach (is_array($namespaces) ? $namespaces : [$namespaces] as $namespace) {
                foreach (ClassFinder::getClassesInNamespace($namespace, config($this->configKey.'namespace_mode', ClassFinder::STANDARD_MODE)) as $class) {
                    foreach (class_uses_recursive($class) as $trait) {
                        if ($this->targetTrait == $trait) {
                            array_push($targetables, $class);
                        }
                    }
                }
            }
            return collect($targetables);
        });
    }

    /**
     * Get the target model.
     */
    public function getTarget(): string
    {
        if (!request()->segments() || $this->targetables->isEmpty()) {
            return '';
        }
        $model = Str::studly(Str::singular(request()->segment(count(explode('/', config($this->configKey.'prefix', 'api'))) + 1)));

        return $this->targetables->first(function ($class) use ($model) {
            return Arr::last(explode('\\', $class)) === $model;
        }) ?: '';
    }
}
