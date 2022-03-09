<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\FilesModule\Folder\Form\FolderFormBuilder;
use Anomaly\FilesModule\Folder\Table\FolderTableBuilder;
use Anomaly\Streams\Platform\Assignment\Form\AssignmentFormBuilder;
use Anomaly\Streams\Platform\Assignment\Table\AssignmentTableBuilder;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class FoldersController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FoldersController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param  FolderTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FolderTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param  FolderFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FolderFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param  FolderFormBuilder                          $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FolderFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    /**
     * Return a table of existing folder assignments.
     *
     * @param  AssignmentTableBuilder                     $table
     * @param  FolderRepositoryInterface                  $folders
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function fields(AssignmentTableBuilder $table, FolderRepositoryInterface $folders, $id)
    {
        /* @var FolderInterface $folder */
        $folder = $folders->find($id);

        $this->breadcrumbs->put($folder->getName(), 'admin/files/folders/edit/' . $folder->getId());
        $this->breadcrumbs->put(
            'streams::breadcrumb.assignments',
            'admin/files/folders/assignments/' . $folder->getId()
        );

        return $table
            ->setButtons(
                [
                    'edit' => [
                        'href' => '{request.path}/assignment/{entry.id}',
                    ],
                ]
            )
            ->setStream($folder->getEntryStream())
            ->render();
    }

    /**
     * Choose a field to assign.
     *
     * @param  FieldRepositoryInterface $fields
     * @return \Illuminate\View\View
     */
    public function choose(FieldRepositoryInterface $fields, FolderRepositoryInterface $folders, $id)
    {
        /* @var FolderInterface $folder */
        $folder = $folders->find($id);

        return view(
            'anomaly.module.files::ajax/choose_field',
            [
                'fields' => $fields->findAllByNamespace('files')->notAssignedTo($folder->getEntryStream())->unlocked(),
                'id'     => $id,
            ]
        );
    }

    /**
     * Create an assignment.
     *
     * @param  AssignmentFormBuilder     $form
     * @param  FolderRepositoryInterface $folders
     * @param  FieldRepositoryInterface  $fields
     * @param                            $id
     * @param                            $field
     * @return mixed
     */
    public function assign(
        AssignmentFormBuilder $form,
        FolderRepositoryInterface $folders,
        FieldRepositoryInterface $fields,
        $id,
        $field
    ) {
        /* @var FolderInterface $folder */
        $folder = $folders->find($id);

        return $form
            ->setStream($folder->getEntryStream())
            ->setField($fields->find($field))
            ->render();
    }

    /**
     * Return a form for an existing file type field and assignment.
     *
     * @param  AssignmentFormBuilder                      $form
     * @param  FolderRepositoryInterface                  $folders
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function assignment(
        AssignmentFormBuilder $form,
        FolderRepositoryInterface $folders,
        $id,
        $assignment
    ) {
        $folder = $folders->find($id);

        $this->breadcrumbs->put('streams::breadcrumb.assignments', 'admin/files/types/assignments/' . $folder->getId());

        return $form->render($assignment);
    }
}
