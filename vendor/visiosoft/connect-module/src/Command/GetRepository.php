<?php namespace Visiosoft\ConnectModule\Command;

class GetRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function handle()
    {

        $collection_class = $this->getApiCollectionClassWithModel($this->model);

        if (class_exists($collection_class)) {
            return app($this->getApiCollectionClassWithModel($this->model));
        }

        return app($this->getRepositoryClassWithModel($this->model));
    }

    public function getRepositoryClassWithModel($model)
    {
        $model = get_class(app($model));
        $modelNamespace = explode('\\', $model);
        $modelName = array_pop($modelNamespace);
        preg_match('/^(.*)Model$/', $modelName, $m);
        $modelName = $m[1];
        $repoNamespace = implode('\\', $modelNamespace);

        return "$repoNamespace\Contract\\{$modelName}RepositoryInterface";
    }

    public function getApiCollectionClassWithModel($model)
    {
        $model = get_class(app($model));
        $modelNamespace = explode('\\', $model);
        $modelName = array_pop($modelNamespace);
        preg_match('/^(.*)Model$/', $modelName, $m);
        $modelName = $m[1];
        $repoNamespace = implode('\\', $modelNamespace);

        return "$repoNamespace\\{$modelName}ApiCollection";
    }


}
