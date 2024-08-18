<?php namespace Visiosoft\CommentsModule\Comment\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CommentRepositoryInterface extends EntryRepositoryInterface
{
    public function getRating($entry_type, $entry_id);

    public function getProductsRateReport();

    public function getProductsCommentsReport();
}
