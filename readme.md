# Event Stream 

## Serve Side Code

> Option: 1

```php
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
let evtSource = new EventSource("/getEventStream", {withCredentials: true});

evtSource.onmessage = function (e) {
 let data = JSON.parse(e.data);
 console.log(data);
};
```