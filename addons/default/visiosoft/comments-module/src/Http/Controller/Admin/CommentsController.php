<?php namespace Visiosoft\CommentsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Visiosoft\CommentsModule\Comment\CommentModel;
use Visiosoft\CommentsModule\Comment\Form\CommentFormBuilder;
use Visiosoft\CommentsModule\Comment\Table\CommentTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class CommentsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param CommentTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CommentTableBuilder $table)
    {
        $table->setColumns([
            'username',
            'title',
            'rating'
        ]);

        $table->setButtons([
            'status' => [
                'text' => function (EntryInterface $entry) {
                    if ($entry->status == 'approved') {
                        return "visiosoft.module.comments::button.revert";
                    } else {
                        return "visiosoft.module.comments::button.approve";
                    }
                },
                'href' => function (EntryInterface $entry) {
                    if ($entry->status == 'approved') {
                        return "/admin/comments/status/{entry.id},0";
                    } else {
                        return "/admin/comments/status/{entry.id},1";
                    }
                },
                'type' => function (EntryInterface $entry) {
                    if ($entry->status == true) {
                        return "danger";
                    } else {
                        return "success";
                    }
                },
            ],
            'edit'
        ]);
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param CommentFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CommentFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param CommentFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CommentFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    public function status(CommentModel $model, $id, $status)
    {
        $comment = $model->find($id);
        if (!is_null($comment)) {
            $comment->update(['status' => $status]);
            $this->messages->success(trans('streams::message.edit_success', ['name' => trans('visiosoft.module.comments::field.status.name')]));
        } else {
            $this->messages->error(trans('streams::message.no_fields_available'));
        }
        return back();

    }
}
