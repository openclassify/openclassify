<?php namespace Visiosoft\CommentsModule\Comment\Command;

use Illuminate\Support\Str;

class getEntries
{
    protected $entryType;
    protected $limit;

    public function __construct($entryType, $limit = 5)
    {
        $this->entryType = $entryType;
        $this->limit = $limit;
    }

    public function handle()
    {
        $entryModel = app($this->entryType);

        $entryType = Str::replace("\\", "\\\\", $this->entryType);
        $entryTable = "default_{$entryModel->getTable()}";

        $entries = $entryModel
            ->selectRaw("$entryTable.*, (
                SELECT AVG(rating)
                FROM default_comments_comments AS comments
                WHERE comments.entry_id = $entryTable.id
                AND comments.status = 1
                AND comments.entry_type = '$entryType'
            ) AS rating")
            ->orderByDesc('rating')
            ->where('status', 'approved')
            ->limit($this->limit)
            ->get();

        return $entries;
    }
}
