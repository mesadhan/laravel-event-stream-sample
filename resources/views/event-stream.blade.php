<style>
    #main_frame {
        border: 5px solid red;
        padding: 20px;
        max-width: 800px;
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
        let data = JSON.parse(e.data);

        console.log('EventData:- ', data);


        let rawData = document.getElementById('rawData');
        let main_frame = document.getElementById('main_frame');
        let content_name = document.getElementById('content_name');
        let content_time = document.getElementById('content_time');
        let content_id = document.getElementById('content_id');
        let content_message = document.getElementById('content_message');

        rawData.textContent = JSON.stringify(data);
        content_name.textContent = data.name;
        content_time.textContent = data.time;
        content_id.textContent = data.id;
        content_message.textContent = data.message;

        let color = getRandomColor();
        main_frame.style.borderColor = color;
        rawData.style.color = color;


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