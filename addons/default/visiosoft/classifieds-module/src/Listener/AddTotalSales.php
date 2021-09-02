<?php namespace Visiosoft\ClassifiedsModule\Listener;

use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;
use Visiosoft\OrdersModule\Orderdetail\Event\CreatedOrderDetail;

class AddTotalSales
{
	private $classifiedModel;
	public function __construct(
		ClassifiedModel $classifiedModel
	)
	{
		$this->classifiedModel = $classifiedModel;
	}

	public function handle(CreatedOrderDetail $event)
    {
    	$item = $event->getOrderItem();
    	if ($item->item_type === 'classified') {
            $classified = $this->classifiedModel->find($event->getOrderItem()->item_id);
            $total = $classified->total_sales + $item->piece;
            $classified->total_sales =  $total;
            $classified->save();
        }
    }
}
