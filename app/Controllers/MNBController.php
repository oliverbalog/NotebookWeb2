<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;
use DateTime;
use Exception;
use SoapClient;

class MNBController extends Controller
{
    private $client;

    public function __construct(RouteCollection $routes)
    {
        parent::__construct($routes);
    }

    public function index()
    {
        return $this->view('mnb');
    }

    public function GetExchangeRates()
    {
        $error = false;

        $data = [
            'curr1' => '',
            'curr2' => '',
            'startDate' => '',
            'endDate' => '',
            'rate' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'curr1' => trim($_POST['curr1']),
                'curr2' => trim($_POST['curr2']),
                'startDate' => trim($_POST['startDate']),
                'endDate' => trim($_POST['endDate']),
                'rate' => '',
            ];
            /* Validating inputs */
            $currencieValidation = "/^[A-Z]*$/";

            try {
                if (empty($data['curr1'])) {
                    $error = true;
                    Input::throwError('Adja meg milyen pénznemről szeretne átváltani!');
                } elseif (!preg_match($currencieValidation, $data['curr1']) || strlen($data['curr1']) != 3) {
                    $error = true;
                    Input::throwError('Hibás pénznem!');
                } elseif (!$this->ValidateCurrencies($data['curr1'])) {
                    $error = true;
                    Input::throwError($data['curr1'] . ' pénznem nem található!');
                }

                if (empty($data['curr2'])) {
                    $error = true;
                    Input::throwError('Adja meg milyen pénznemre szeretne átváltani!');
                } elseif (!preg_match($currencieValidation, $data['curr2']) || strlen($data['curr2']) != 3) {
                    $error = true;
                    Input::throwError('Hibás pénznemet adott meg!');
                } elseif (!$this->ValidateCurrencies($data['curr2'])) {
                    $error = true;
                    Input::throwError($data['curr2'] . ' pénznem nem található!');
                }
            } catch (Exception $e) {
                return $this->view('mnb', [
                    'errors' => $e->getMessage()
                ]);
            }

            if ($error == false) {
                try {
                    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
                    $rates = simplexml_load_string($client->GetExchangeRates(
                        array('startDate' => $data["startDate"], 'endDate' => $data["endDate"], 'currencyNames' => $data["curr1"] . "," . $data["curr2"])
                    )->GetExchangeRatesResult);
                    $ratescount = $rates->count();

                    $resultData = array();

                    for ($i = 0; $i < $ratescount; $i++) {
                        $resultData[$i]["curr1"] = $data["curr1"];
                        $resultData[$i]["curr2"] = $data["curr2"];
                        $resultData[$i]["date"] = (string) $rates->Day[$i]->attributes()->date;
                        $resultData[$i]["rate"] = (string) $rates->Day[$i]->Rate;

                    }

                } catch (SoapFault $e) {
                    return $this->view('index', [
                        'errors' => $e->getMessage()
                    ]);
                }
            }
        } else {
            $data = [
                'curr1' => '',
                'curr2' => '',
                'startDate' => '',
                'endDate' => '',
                'rate' => '',
            ];
            $resultData = [];
        }
        return $this->view('mnb', [
            'resultData' => $resultData
        ]);
    }
    public function GetCurrentRates()
    {
        $error = false;

        $data = [
            'curr1' => '',
            'curr2' => '',
            'unit1' => '',
            'unit2' => '',
            'rate1' => '',
            'rate2' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'curr1' => trim($_POST['curr1']),
                'curr2' => trim($_POST['curr2']),
                'unit1' => '',
                'unit2' => '',
                'rate1' => '',
                'rate2' => ''
            ];

            /* Validating inputs */
            $currencieValidation = "/^[A-Z]*$/";

            try {
                if (empty($data['curr1'])) {
                    $error = true;
                    Input::throwError('Adja meg milyen pénznemről szeretne átváltani!');
                } elseif (!preg_match($currencieValidation, $data['curr1']) || strlen($data['curr1']) != 3) {
                    $error = true;
                    Input::throwError('Hibás pénznem!');
                } elseif (!$this->ValidateCurrencies($data['curr1'])) {
                    $error = true;
                    Input::throwError($data['curr1'] . ' pénznem nem található!');
                }

                if (empty($data['curr2'])) {
                    $error = true;
                    Input::throwError('Adja meg milyen pénznemre szeretne átváltani!');
                } elseif (!preg_match($currencieValidation, $data['curr2']) || strlen($data['curr2']) != 3) {
                    $error = true;
                    Input::throwError('Hibás pénznemet adott meg!');
                } elseif (!$this->ValidateCurrencies($data['curr2'])) {
                    $error = true;
                    Input::throwError($data['curr2'] . ' pénznem nem található!');
                }
            } catch (Exception $e) {
                return $this->view('mnb', [
                    'errors' => $e->getMessage()
                ]);
            }

            if ($error == false) {
                try {
                    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
                    $result = simplexml_load_string($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);

                    $count = $result->Day[0]->count();

                    for ($i = 0; $i <= $count - 1; $i++) {
                        $j = 0;

                        foreach ($result->Day[0]->Rate[$i]->attributes() as $a => $b) {
                            $curexc_array[$i][$j] = $b->__toString();
                            $j = $j + 1;

                            if ($j == 2) {
                                $j = 0;
                            }
                        }
                        $curexc_array[$i][2] = $result->Day[0]->Rate[$i]->__toString();
                    }
                } catch (SoapFault $e) {
                    return $this->view('index', [
                        'errors' => $e->getMessage()
                    ]);
                }

                $rate1 = 0;
                $rate2 = 0;

                for ($i = 0; $i <= $count - 1; $i++) {
                    if ($data['curr1'] == "HUF") {
                        $unit1 = 1;
                        $rate1 = 1;
                    } else {
                        if ($curexc_array[$i][1] == $data['curr1']) {
                            $unit1 = $curexc_array[$i][0];
                            $rate1 = $curexc_array[$i][2];
                        }
                    }

                    if ($data['curr2'] == "HUF") {
                        $unit2 = 1;
                        $rate2 = 1;
                    } else {
                        if ($curexc_array[$i][1] == $data['curr2']) {
                            $unit2 = $curexc_array[$i][0];
                            $rate2 = $curexc_array[$i][2];
                        }
                    }
                }

                if ($rate1 == 0) {
                    $error = true;
                    Input::throwError('A ' . $data['curr1'] . ' pénznemhez nincs információ erre a dátumra.');
                }
                if ($rate2 == 0) {
                    $error = true;
                    Input::throwError('A ' . $data['curr2'] . ' pénznemhez nincs információ erre a dátumra.');
                }

                if ($error == false) {
                    $f_unit1 = floatval($unit1);
                    $f_unit2 = floatval($unit2);
                    $f_rate1 = floatval($rate1);
                    $f_rate2 = floatval($rate2);

                    if ($data['curr1'] == "HUF") {
                        $div_rate = $f_unit2 / $f_rate2;
                        if ($div_rate < 1) {
                            $unit1 = 100;
                            $div_rate = $div_rate * 100;
                        }
                        $data['unit1'] = $unit2;
                        $data['rate1'] = round(floatval($rate2), 2);
                        $data['unit2'] = $unit1;
                        $data['rate2'] = round($div_rate, 2);
                    } elseif ($data['curr2'] == "HUF") {
                        $div_rate = $f_unit1 / $f_rate1;
                        if ($div_rate < 1) {
                            $unit2 = 100;
                            $div_rate = $div_rate * 100;
                        }
                        $data['unit1'] = $unit2;
                        $data['rate1'] = round($div_rate, 2);
                        $data['unit2'] = $unit1;
                        $data['rate2'] = round(floatval($rate1), 2);
                    } else {
                        $div_rate1 = ($f_unit1 / $f_rate1 * $f_unit1) * ($f_rate2 / $f_unit2);
                        $div_rate2 = ($f_unit2 / $f_rate2 * $f_unit2) * ($f_rate1 / $f_unit1);
                        if ($div_rate1 < 1) {
                            $unit1 = 100;
                            $div_rate1 = $div_rate1 * 100;
                        }
                        if ($div_rate2 < 1) {
                            $unit2 = 100;
                            $div_rate2 = $div_rate2 * 100;
                        }
                        $data['unit1'] = $unit1;
                        $data['rate1'] = round($div_rate1, 2);
                        $data['unit2'] = $unit2;
                        $data['rate2'] = round($div_rate2, 2);
                    }
                }
            }
        } else {
            $data = [
                'curr1' => '',
                'curr2' => '',
                'unit1' => '',
                'unit2' => '',
                'rate1' => '',
                'rate2' => ''
            ];
        }



        return $this->view('mnb', [
            'data' => $data
        ]);
    }

    public function ValidateCurrencies($curr)
    {
        try {
            $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
            $result = json_decode(json_encode((array) simplexml_load_string($client->GetCurrencies()->GetCurrenciesResult)), 1);
            $cur_array = $result['Currencies'];
            $array = $cur_array['Curr'];
        } catch (SoapFault $e) {
            return $this->view('mnb', [
                'errors' => $e->getMessage()
            ]);
        }

        if (in_array($curr, $array)) {
            return true;
        } else {
            return false;
        }
    }
}