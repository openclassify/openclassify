<?php namespace Visiosoft\AdvsModule\Adv;

use Visiosoft\AdvsModule\Adv\Command\AddSlug;
use Visiosoft\AdvsModule\Adv\Command\DeleteOptionConfiguration;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Visiosoft\AdvsModule\Adv\Event\DeletedAd;
use Visiosoft\AdvsModule\Adv\Event\DeletingAd;
use Illuminate\Support\Facades\DB;

class AdvObserver extends EntryObserver
{
    private function translateFixer($entryId)
    {

        //TODO TEMP LANG FIX WITH FATIH.
        $transCount = DB::table('advs_advs_translations')
            ->select('id')
            ->whereNull('name')
            ->where('entry_id', $entryId)
            ->count();


        if ($transCount > 1) {
            DB::table('advs_advs_translations')
                ->whereNull('name')
                ->where('entry_id', $entryId)
                ->delete();
        }
    }

    public function created(EntryInterface $entry)
    {
        $this->translateFixer($entry->getId());
    }

    public function updated(EntryInterface $entry)
    {
        $this->translateFixer($entry->getId());
    }

    public function updating(EntryInterface $entry)
    {
        $this->dispatchSync(new AddSlug($entry));
        parent::updating($entry);
    }

    public function deleting(EntryInterface $entry)
    {
        $this->dispatchSync(new DeleteOptionConfiguration($entry));

        event(new DeletingAd($entry));

        parent::deleting($entry);
    }

    public function deleted(EntryInterface $entry)
    {
        event(new DeletedAd($entry));
        parent::deleted($entry);
    }
}
