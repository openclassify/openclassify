<?php namespace Visiosoft\AdvsModule\OptionConfiguration\Table;


use Anomaly\Streams\Platform\Entry\EntryModel;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class OptionConfigurationTableColumns
{
	public function handle(
		OptionConfigurationTableBuilder $builder
	)
	{
		$builder->setColumns([
			'name' => [
				'value' => function (EntryModel $entry,
				                     AdvRepositoryInterface $advRepository) {

					$adv = $advRepository->find($entry->parent_adv_id);
                    if (setting_value('visiosoft.module.advs::translatable_slug')){
					    return "<span><a href='" . route('adv_detail_mlang', [trans('visiosoft.module.advs::slug.detail_adv'),$entry->parent_adv_id]) . "'>$adv->name</a></span>";
                    }
                    return "<span><a href='" . route('adv_detail', [$entry->parent_adv_id]) . "'>$adv->name</a></span>";

                }
			],
			'option_json' => [
				'value' => function (EntryModel $entry,
				                     ProductoptionRepositoryInterface $productOptionRepository,
				                     ProductoptionsValueRepositoryInterface $productOptionsValueRepository) {

					$values = json_decode($entry->option_json);
					$text = "";

					foreach ($values as $key => $value) {
						$productOption = $productOptionRepository->findBy('entry_id', $key);
						$productOptionsValue = $productOptionsValueRepository->findBy('entry_id', $value);

						$text .=
							'<span class="tag tag-sm tag-info mr-1">' .
							$productOption->name . ': ' . $productOptionsValue->name .
							'</span>';

					}

					return $text;
				}
			],
		]);
	}
}
