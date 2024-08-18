<?php namespace Visiosoft\CommentsModule\Comment\Events;

class CreateNewComment
{
    private $entry;
    private $comment;

    public function __construct($entry, $comment)
    {
        $this->entry = $entry;
        $this->comment = $comment;
    }

    public function getEntry()
    {
        return $this->entry;
    }

    public function getComment()
    {
        return $this->comment;
    }
}

