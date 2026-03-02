<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Anomaly\Streams\Platform\Message\MessageBag;

class ConvertCurrency
{
    protected $price;
    protected $currency;
    protected $source;
    protected $to;

    public function __construct($price, $source, $to)
    {
        $this->price = $price;
        $this->currency = $source;
        $this->source = $source;
        $this->to = $to;
    }

    public function handle(MessageBag $message)
    {
        try {
            $url = $this->source . "_" . $this->to;
            $freeCurrencyKey = setting_value('visiosoft.module.advs::free_currencyconverterapi_key');

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'http://free.currencyconverterapi.com/api/v6/convert', ['query' => [
                'q' => $url,
                'compact' => 'y',
                'apiKey' => $freeCurrencyKey
            ]]);

            if ($response->getStatusCode() == '200') {
                $response = (array)\GuzzleHttp\json_decode($response->getBody()->getContents());
                if (!empty($response)) {
                    $rate = $response[$url]->val;
                    $this->price *= $rate;
                    $this->currency = $this->to;
                }
            }
        } catch (\Exception $e) {
            $message->error(trans('visiosoft.module.advs::message.currency_converter_not_available'));
        }

        return [
            'currency' => $this->currency,
            'price' => $this->price,
        ];
    }
}
