<?php namespace Visiosoft\CommentsModule\Comment\Listener;

use Anomaly\Streams\Platform\Message\MessageBag;
use Visiosoft\CommentsModule\Comment\Contract\CommentRepositoryInterface;
use Visiosoft\CommentsModule\Comment\Events\CreateNewComment;

class SaveComment
{
    private $repository;
    private $message;

    public function __construct(CommentRepositoryInterface $repository, MessageBag $message)
    {
        $this->repository = $repository;
        $this->message = $message;
    }

    public function handle(CreateNewComment $event)
    {
        $this->repository->create(array_merge(['entry' => $event->getEntry()], $event->getComment()));
    }
}