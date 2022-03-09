<?php namespace Visiosoft\ConnectModule\Resource\Contract;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Illuminate\Support\Collection;

/**
 * Interface ResourceRepositoryInterface
 *

 * @package       Visiosoft\ConnectModule\Resource\Contract
 */
interface ResourceRepositoryInterface
{

    /**
     * Get the resource entries.
     *
     * @param ResourceBuilder $builder
     * @return Collection
     */
    public function get(ResourceBuilder $builder);

    public function getRepositoryWithModel($model);

    public function getRepositoryEntries(ResourceBuilder $builder);

    public function getModelFunctions($model, $function_name, array $params = []);

    public function getRepositoryFunctions($model, $function_name, array $params = []);

    public function returnQuerying($query, $builder);
}
