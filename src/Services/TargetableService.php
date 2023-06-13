<?php

namespace berthott\Targetable\Services;

use berthott\Targetable\Enums\Mode;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * Abstract class to be overwritten.
 */
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
    private string $targetClass;

    /**
     * Collection with all targetable classes.
     */
    private Collection $targetables;

    /**
     * The mode in which the targetable operates.
     */
    private Mode $mode;

    /**
     * The constructor should be called by its descending class.
     * 
     * For more information see {@link guide/readme/index.html the readme page}.
     * 
     * @api
     * @param string    $targetClass    The class that will be targeted.
     * @param string    $configKey      The name of the config file.
     * @param Mode      $mod            The mode for finding the target.
     * @return void
     */
    public function __construct(string $targetClass, string $configKey, Mode $mode = Mode::Trait)
    {
        $this->targetClass = $targetClass;
        $this->configKey = $configKey;
        $this->mode = $mode;
        $this->cacheKey = get_class($this).'-Cache-Key';
        $this->initTargetableClasses();
    }

    /**
     * Get the targetable classes collection.
     * 
     * Returns the collection of all classes that use a the target class / trait.
     * 
     * @api
     */
    public function getTargetableClasses(): Collection
    {
        return $this->targetables;
    }

    /**
     * Initialize the targetable classes collection.
     */
    private function initTargetableClasses()
    {
        $this->targetables = Cache::sear($this->cacheKey, function () {
            $targetables = [];
            $namespaces = config($this->configKey.'.namespace', 'App\Models');
            foreach (is_array($namespaces) ? $namespaces : [$namespaces] as $namespace) {
                foreach (ClassFinder::getClassesInNamespace($namespace, config($this->configKey.'namespace_mode', ClassFinder::STANDARD_MODE)) as $class) {
                    foreach ($this->mode === Mode::Trait ? class_uses_recursive($class) : class_implements($class) as $trait) {
                        if ($this->targetClass == $trait) {
                            array_push($targetables, $class);
                        }
                    }
                }
            }
            return collect($targetables);
        });
    }

    /**
     * Get the target model for the current request.
     * 
     * Analyzes the current request route and returns the matching target class.
     * 
     * @api
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
