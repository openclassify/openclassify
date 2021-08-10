<?php namespace Visiosoft\AdvsModule\Listener;

use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\OrdersModule\Orderdetail\Event\CreatedOrderDetail;

class AddTotalSales
{
	private $advModel;
	public function __construct(
		AdvModel $advModel
	)
	{
		$this->advModel = $advModel;
	}

	public function handle(CreatedOrderDetail $event)
    {
    	$item = $event->getOrderItem();
    	if ($item->item_type === 'adv') {
            $adv = $this->advModel->find($event->getOrderItem()->item_id);
            $total = $adv->total_sales + $item->piece;
            $adv->total_sales =  $total;
            $adv->save();
        }
    }
}
