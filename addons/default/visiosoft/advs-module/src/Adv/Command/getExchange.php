<?php namespace Visiosoft\AdvsModule\Adv\Command;

class getExchange
{
    public $currency;

    public function __construct($currency = null)
    {
        $this->currency = $currency;
    }

    public function handle()
    {
        $exchange_xml = simplexml_load_file(setting_value('visiosoft.module.advs::tcmb_exchange_url') . '/today.xml');
        $exchange_xml = json_decode(json_encode($exchange_xml), TRUE);
        $exchange = [
            'USD' => 0,
            'EUR' => 3,
        ];

        foreach ($exchange as $key => $exchange_key) {

            $buy = $exchange_xml['Currency'][$exchange_key]['BanknoteSelling'];
            $exchange[$key] = [
                'sell' => $exchange_xml['Currency'][$exchange_key]['BanknoteBuying'],
                'buy' => $buy,
                'status' => $this->getStatus($buy, $exchange_key)
            ];
        }

        if ($this->currency) {
            if (array_key_exists($this->currency, $exchange)) {
                return $exchange[$this->currency];
            }
            return null;
        }
        return $exchange;
    }

    public function getStatus($today_buy, $exchange_key)
    {
        $today = now();

        $number_of_days_to_be_reduced = 1;
        if ($today->format('D') == 'Mon') {
            $number_of_days_to_be_reduced = 3;
        } else if ($today->format('D') == 'Sun') {
            $number_of_days_to_be_reduced = 2;
        }


        $date = $today->addDays('-' . $number_of_days_to_be_reduced);

        $year_and_month = $date->format('Ym');
        $date = $date->format('dmY');


        $exchange_xml = simplexml_load_file(setting_value('visiosoft.module.advs::tcmb_exchange_url') . '/' . $year_and_month . '/' . $date . '.xml');
        $exchange_xml = json_decode(json_encode($exchange_xml), TRUE);

        $old_buy = $exchange_xml['Currency'][$exchange_key]['BanknoteSelling'];

        $difference = ($today_buy * 10000) - ($old_buy * 10000);

        if ($difference > 0) {
            return 'increased';
        } elseif ($difference < 0) {
            return 'decreased';
        }
        return 'equal';
    }
}
