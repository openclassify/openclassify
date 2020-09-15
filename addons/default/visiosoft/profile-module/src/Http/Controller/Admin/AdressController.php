<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Visiosoft\ProfileModule\Adress\Form\AdressFormBuilder;
use Visiosoft\ProfileModule\Adress\Table\AdressTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class AdressController extends AdminController
{

    private $adressRepository;

    public function __construct(AdressRepositoryInterface $adressRepository)
    {
        parent::__construct();
        $this->adressRepository = $adressRepository;
    }

    /**
     * Display an index of existing entries.
     *
     * @param AdressTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AdressTableBuilder $table)
    {
        $table->setColumns(array_merge($table->getColumns(), [
            'city' => [
                'value' => function (EntryInterface $entry, CityRepositoryInterface $cityRepository) {
                    return $cityRepository->find($entry->city)->name;
                },
            ],
        ]));

        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param AdressFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(AdressFormBuilder $form)
    {
        $form->setOption('heading', "visiosoft.module.profile::field");

        return $form->render();
    }
}
