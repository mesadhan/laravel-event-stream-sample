
<h1 style="text-align: center; margin: 50px;" id="content"></h1>


<script>

    let evtSource = new EventSource("/getEventStream", {withCredentials: true});

     evtSource.onmessage = function (e) {
         let data = JSON.parse(e.data);
         console.log(data);

         let content = document.getElementById('content');
         content.textContent = JSON.stringify(data);
     };

</script>