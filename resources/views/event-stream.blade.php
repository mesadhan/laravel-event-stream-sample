<style>
    #main_frame {
        border: 5px solid red;
        padding: 25px;
        max-width: 850px;
        margin: 0 auto;
    }

    .main_content {
        text-align: center;
        margin: 50px;
    }
</style>

<h1 class="main_content">Laravel-Event Stream- Server Send Event</h1>

<div id="main_frame">
    <div> Name: <span id="content_name"></span></div>
    <div> Time: <span id="content_time"></span></div>
    <div> ID: <span id="content_id"></span></div>
    <div> Message: <span id="content_message"></span></div>

    <h3 id="rawData"></h3>
</div>


<script>

    let evtSource = new EventSource("/getEventStream", {withCredentials: true});

    evtSource.onmessage = function (e) {
        let serverData = JSON.parse(e.data);

        console.log('EventData:- ', serverData);


        let rawData = document.getElementById('rawData');
        let main_frame = document.getElementById('main_frame');
        let content_name = document.getElementById('content_name');
        let content_time = document.getElementById('content_time');
        let content_id = document.getElementById('content_id');
        let content_message = document.getElementById('content_message');

        content_name.textContent = serverData.name;
        content_time.textContent = serverData.time;
        content_id.textContent = serverData.id;
        content_message.textContent = serverData.message;


        let color = getRandomColor();
        serverData['color'] = color;                // set color in server object
        main_frame.style.borderColor = color;
        //rawData.style.color = color;

        rawData.textContent = JSON.stringify(serverData);
    };


    function getRandomColor() {
        let letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        console.log('Selected color:- ', color);
        return color;
    }

</script>