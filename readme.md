# Laravel-Event Stream- Server Send Event
Server-Sent Events is a web API for subscribing to a data stream sent by a server.
This opens up a network request to the server so we can stream. 
Think of it like a Promise that never resolves. 
Easy implementable using native JavaScript.

## To Run application

- [ ] Just Clone application
- [ ] Then Install Packages
    
```bash
    $ composer install
```

- [ ] Then Install Run Server

```bash
    $ php artisan serve
```

- [ ] Now Open Browser at [http://localhost:8000](http://localhost:8000)



## Serve Side Code

> Option: 1

```php

//php
//import at the begining
use Symfony\Component\HttpFoundation\StreamedResponse;

//...

$response = new StreamedResponse(function() use ($request) {
    while(true) {
        echo 'data: ' . json_encode(Stock::all()) . "\n\n";
        ob_flush();
        flush();
        usleep(200000);
    }
});

$response->headers->set('Content-Type', 'text/event-stream');
$response->headers->set('X-Accel-Buffering', 'no');
$response->headers->set('Cach-Control', 'no-cache');
return $response;
``` 

> Option: 2

```php

//php
//import at the begining
use Symfony\Component\HttpFoundation\StreamedResponse;

//...
$random_string = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90));
$data = [
    'message' => $random_string,
    'name' => 'Sadhan Sarker',
    'time' => date('h:i:s'),
    'id' => rand(10, 100),
];

$response = new StreamedResponse();
$response->setCallback(function () use ($data){

     echo 'data: ' . json_encode($data) . "\n\n";
     //echo "retry: 100\n\n"; // no retry would default to 3 seconds.
     //echo "data: Hello There\n\n";
     ob_flush();
     flush();
     //sleep(10);
     usleep(200000);
});

$response->headers->set('Content-Type', 'text/event-stream');
$response->headers->set('X-Accel-Buffering', 'no');
$response->headers->set('Cach-Control', 'no-cache');
$response->send();
``` 


## Client Side Code
```javascript
// javascript

let evtSource = new EventSource("/getEventStream", {withCredentials: true});

evtSource.onmessage = function (e) {
 let data = JSON.parse(e.data);
 console.log(data);
};
```


## Referenes

 - https://developer.mozilla.org/en-US/docs/Web/API/Server-sent_events/Using_server-sent_events