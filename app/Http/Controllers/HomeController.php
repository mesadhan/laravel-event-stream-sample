<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;


class HomeController extends Controller
{
    public function getEventStream()
    {


        $nameArray = [
            'MD. Sadhan Sarker', 'MD. Ripon Sarker', 'Hannan Taluker', 'Korim Islam', 'Reazul Islam',
        ];
        $random_name = $nameArray[rand(1, count($nameArray)-1)];

        $random_string = chr(rand(65, 90)) . chr(rand(65, 90)) . '-' . chr(rand(65, 90)) . '-' . chr(rand(65, 90)) . '-' . chr(rand(65, 90));

        $data = [
            'id' => rand(10, 100),
            'time' => date('h:i:s'),
            'message' => $random_string,
            'name' => $random_name
        ];

        $response = new StreamedResponse();
        $response->setCallback(function () use ($data) {

            echo 'data: ' . json_encode($data) . "\n\n";
            //echo "retry: 100\n\n"; // no retry would default to 3 seconds.
            //echo "data: Hello There\n\n";
            ob_flush();
            flush();
            //sleep(10);
            usleep(2000);
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->send();
    }

}
