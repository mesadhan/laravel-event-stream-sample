<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;


class HomeController extends Controller
{
    public function getEventStream()
    {

        $random_string = chr(rand(65, 90)) . chr(rand(65, 90)) .'-'.  chr(rand(65, 90)) .'-'.  chr(rand(65, 90)) .'-'.  chr(rand(65, 90));
        $data = [
            'time' => date('h:i:s'),
            'message' => $random_string,
            'id' => rand(10, 100),
            'name' => 'Sadhan Sarker',
        ];


        $response = new StreamedResponse();
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->setCallback(function () use ($data){

            echo 'data: ' . json_encode($data) . "\n\n";
            //echo "retry: 100\n\n"; // no retry would default to 3 seconds.
            //echo "data: Hello There\n\n";
            ob_flush();
            flush();
            //sleep(10);
            usleep(20000);
        });
        $response->send();



    }

}
