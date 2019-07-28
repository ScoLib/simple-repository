<?php
declare(strict_types=1);

namespace Sco\Repository;

interface RepositoryInterface
{
    /**
     * Set the repository model.
     *
     * @param string $model
     *
     * @return static
     */
    public function setModel($model);

    /**
     * Get the repository model.
     *
     * @return string
     */
    public function getModel(): string;

    /**
     * Create a new repository model instance.
     *
     * @return mixed
     * @throws \InvalidArgumentException
     *
     */
    public function createModel();

    /**
     * Dynamically pass missing static methods to the model.
     *
     * @param $method
     * @param $parameters
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters);

    /**
     * Dynamically pass missing methods to the model.
     *
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters);
}
