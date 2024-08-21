<?php namespace Visiosoft\RestateTheme\Handler;

use Anomaly\PagesModule\Page\PageModel;

class pagesFindBySlug
{
	protected $slug;

	public function __construct($slug)
	{
		$this->slug = $slug;
	}

	public function handle()
	{
		return PageModel::query()
			->leftJoin('pages_pages_translations',
				'pages_pages_translations.entry_id',
				'pages_pages.id')
			->where('locale', setting_value('streams::default_locale'))
			->where('slug', $this->slug)
			->first()->entry_id;
	}
}
