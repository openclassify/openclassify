<?php namespace Visiosoft\ClassifiedsModule\OptionConfiguration\Table;


use Anomaly\Streams\Platform\Entry\EntryModel;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\ClassifiedsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\ClassifiedsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\ClassifiedsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class OptionConfigurationTableColumns
{
	public function handle(
		OptionConfigurationTableBuilder $builder
	)
	{
		$builder->setColumns([
			'name' => [
				'value' => function (EntryModel $entry,
				                     ClassifiedRepositoryInterface $classifiedRepository) {

					$classified = $classifiedRepository->find($entry->parent_classified_id);
					return "<span><a href='" . route('classified_detail', [$entry->parent_classified_id]) . "'>$classified->name</a></span>";
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
