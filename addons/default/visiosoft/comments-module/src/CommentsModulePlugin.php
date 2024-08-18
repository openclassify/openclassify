<?php namespace Visiosoft\CommentsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\CommentsModule\Comment\Command\getComments;
use Visiosoft\CommentsModule\Comment\Command\getEntries;
use Visiosoft\CommentsModule\Comment\Contract\CommentRepositoryInterface;

class CommentsModulePlugin extends Plugin
{
    private $repository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->repository = $commentRepository;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction(
                'getComments',
                function ($entry_type, $id) {

                    if (!$comments = $this->dispatch(new getComments($entry_type, $id))) {
                        return null;
                    }
                    return $comments;
                }
            ),
            new \Twig\TwigFunction(
                'getRating',
                function ($entry_type, $entry_id) {
                    if (!$rating = $this->repository->getRating($entry_type, $entry_id)) {
                        return null;
                    }
                    return $rating;
                }
            ),
            new \Twig\TwigFunction(
                'getEntries',
                function ($entryType, $limit = 5) {
                    return $this->dispatch(new getEntries($entryType, $limit));
                }
            ),
        ];
    }
}
