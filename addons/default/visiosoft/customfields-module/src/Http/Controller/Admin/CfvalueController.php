<?php namespace Visiosoft\CustomfieldsModule\Http\Controller\Admin;

use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CustomfieldsModule\Cfvalue\CfvalueModel;
use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Visiosoft\CustomfieldsModule\Cfvalue\Form\CfvalueFormBuilder;
use Visiosoft\CustomfieldsModule\Cfvalue\Table\CfvalueTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\CustomFieldModel;
use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;

class CfvalueController extends AdminController
{
    private $parent;
    private $category;
    private $model;
    private $customFieldRepository;
    private $cfvalueRepository;

    public function __construct(
        ParentRepositoryInterface $parentRepository,
        CategoryModel $categoryModel,
        CfvalueModel $cfvalueModel,
        CustomFieldRepositoryInterface $customFieldRepository,
        CfvalueRepositoryInterface $cfvalueRepository
    )
    {
        parent::__construct();
        $this->parent = $parentRepository;
        $this->category = $categoryModel;
        $this->model = $cfvalueModel;
        $this->customFieldRepository = $customFieldRepository;
        $this->cfvalueRepository = $cfvalueRepository;
    }

    public function index(CfvalueTableBuilder $table)
    {
        if ($this->request->action == "delete") {
            $id_list = $this->request->id;
            foreach ($id_list as $item) {
                $cfValue = $this->model->find($item);
                $cfValue->delete();
            }

            $this->messages->success(trans('streams::message.delete_success', ['count' => count($id_list)]));
            return $this->redirect->to('/admin/customfields/cfvalue');
        }

        return $table->render();
    }

    public function choose(CustomFieldModel $customfields)
    {
        $customfieldType = [];
        foreach ($customfields->selectableType() as $customfield) {
            $categories = $this->getParentCategories($customfield->id);

            //Add Categories Name
            if (count($categories)) {
                $categories_name = array();
                foreach ($categories as $category) {
                    $categories_name[] = $category->name;
                }
                $customfieldType[$customfield->id] = [
                    'id' => $customfield->id,
                    'name' => $customfield->name,
                    'category' => implode(', ', $categories_name),
                ];
            } else {
                //All Category
                $customfieldType[$customfield->id] = [
                    'id' => $customfield->id,
                    'name' => $customfield->name,
                    'category' => trans('visiosoft.module.customfields::field.all'),
                ];
            }
        }

        return $this->view->make('module::admin/cfvalue/choose', ['types' => $customfieldType]);
    }

    public function create(CfvalueFormBuilder $form)
    {
        // Check if type is selected
        if (!request()->type) {
            $this->messages->error('visiosoft.module.customfields::message.select_type_error');
            return redirect('admin/customfields/cfvalue');
        }

        $customFieldType = $this->customFieldRepository->find(request()->type);

        $fields = $form->getFields();

        if ($customFieldType->type === 'selectimage') {
            $fields = array_merge($fields, [
                'custom_field_image'
            ]);
        }

        $form->setFields($fields);
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param CfvalueFormBuilder $form
     * @param        $id
     * @param CfvalueRepositoryInterface $cfvalueRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CfvalueFormBuilder $form, $id)
    {
        $entry = $this->cfvalueRepository->find($id);
        $customField = $this->customFieldRepository->find($entry->custom_field_id);

        if (!$customField) {
            $entry->delete();
            $this->messages->error("visiosoft.module.customfields::message.value_cf_not_exist");
            return redirect('admin/customfields/cfvalue');
        }

	    $fields = $form->getFields();

	    if ($customField->type === 'selectimage') {
            $fields = array_merge($fields, [
                'custom_field_image'
            ]);
        }

	    $form->setFields($fields);

	    return $form->render($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function getParentCategories($id)
    {
        $categories = array();
        $parents = $this->parent->getByCustomFieldID($id);

        foreach ($parents as $parent) {
            $category = $this->category->find($parent->cat_id);
            if ($category)
                $categories[] = $category;
        }
        return $categories;
    }
}
