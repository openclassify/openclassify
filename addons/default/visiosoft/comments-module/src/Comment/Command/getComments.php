<?php namespace Visiosoft\CommentsModule\Comment\Command;

use Visiosoft\CommentsModule\Comment\Contract\CommentRepositoryInterface;

class getComments
{

    protected $id;

    protected $entry_type;


    public function __construct($entry_type, $id)
    {
        $this->id = $id;
        $this->entry_type = $entry_type;
    }

    public function handle(CommentRepositoryInterface $groups)
    {
        return $groups->newQuery()->where('entry_id', $this->id)
            ->where('status', 1)
            ->where('entry_type', $this->entry_type)
            ->orderByDesc('created_at')->get();
    }
}
