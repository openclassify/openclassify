<?php namespace Visiosoft\CommentsModule\Comment;

use Visiosoft\CommentsModule\Comment\Contract\CommentInterface;
use Anomaly\Streams\Platform\Model\Comments\CommentsCommentsEntryModel;

class CommentModel extends CommentsCommentsEntryModel implements CommentInterface
{
    public function getComments($id = null)
    {
        if($id)
        {
            return CommentModel::query()
                ->where('entry_id', $id)->where('status', 1);
        }
        return CommentModel::query();
    }
}
