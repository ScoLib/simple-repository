<?php
declare(strict_types=1);

namespace Sco\Repository;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * The repository model.
     *
     * @var string
     */
    protected $model;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getModel(): string
    {
        $model = $this->app['config']->get('simple.repository.models');

        return $this->model ?: str_replace(
            ['Repositories', 'Repository'],
            [$model, ''],
            static::class
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createModel()
    {
        if (is_string($model = $this->getModel())) {
            if (! class_exists($model)) {
                throw new \InvalidArgumentException("Class {$model} does NOT exist!");
            }

            $model = $this->app->make($model);
        }

        if (! $model instanceof Model) {
            throw new \InvalidArgumentException("Class {$model} must be an instance of \\Illuminate\\Database\\Eloquent\\Model");
        }

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public static function __callStatic($method, $parameters)
    {
        return call_user_func_array([new static(), $method], $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->createModel(), $method], $parameters);
    }
}
