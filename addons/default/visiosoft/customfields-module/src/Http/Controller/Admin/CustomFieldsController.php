<?php namespace Visiosoft\CustomfieldsModule\Http\Controller\Admin;

use Visiosoft\CatsModule\Category\CategoryRepository;
use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\Form\CustomFieldFormBuilder;
use Visiosoft\CustomfieldsModule\CustomField\Table\CustomFieldTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;

class CustomFieldsController extends AdminController
{
    public $customfield_repository;
    public $CFValue_repository;
    public $Parent_Repository;

    public function __construct(
        CustomFieldRepositoryInterface $customFieldRepository,
        CfvalueRepositoryInterface $cfvalueRepository,
        ParentRepositoryInterface $parentRepository
    )
    {
        $this->customfield_repository = $customFieldRepository;
        $this->CFValue_repository = $cfvalueRepository;
        $this->Parent_Repository = $parentRepository;
        parent::__construct();
    }

    public function index(CustomFieldTableBuilder $table)
    {
        if ($this->request->action == "delete") {
            $id_list = $this->request->id;
            foreach ($id_list as $item) {
                $this->customfield_repository->deleteCF($item);
                $this->CFValue_repository->deleteByCF($item);
                $this->Parent_Repository->deleteByCF($item);
            }

            $this->messages->success(trans('streams::message.delete_success', ['count' => count($id_list)]));
            return $this->redirect->to('/admin/customfields');
        }

        return $table->render();
    }

    public function create(CustomFieldFormBuilder $form)
    {
        return $form->render();
    }

    public function edit(CustomFieldFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    public function getSubCats($id,CategoryRepository $categoryRepository) {

        $cats = $categoryRepository->getSubCatById($id);

        return $this->view->make('module::admin/customfields/sub_cats', ['cats' => $cats]);

    }

}
