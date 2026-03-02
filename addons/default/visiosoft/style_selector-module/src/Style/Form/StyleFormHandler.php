<?php namespace Visiosoft\StyleSelectorModule\Style\Form;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StyleFormHandler
{
    public function handle(StyleFormBuilder $builder)
    {
        if (!$builder->canSave()) {
            return;
        }

        $namespace = "visiosoft.module.style_selector";

        $values = array();

        foreach ($builder->getPostData() as $key => $value) {
            $item = array();
            $item['value'] = $value;
            $item['key'] = $namespace . "::" . $key;
            $item['created_at'] = Carbon::now();
            $item['updated_at'] = Carbon::now();
            $item['created_by_id'] = Auth::id();
            $item['updated_by_id'] = Auth::id();

            $values[] = $item;
        }

        DB::table('settings_settings')->upsert($values, 'key');

        Artisan::call('assets:clear');
    }
}
