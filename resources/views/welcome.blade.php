<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Socket io app</title>
    </head>
    <body>
      <ul class="chat"></ul>
      <hr>

      <form>
        <textarea style="width:100%;height:50px"></textarea>
        <input type="submit" value="Send">
      </form>


      <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

      <script>
        var socket = io(':6001');

        function appendMessage(data){
          $('.chat').append(
            $('<li/>').text(data.message)
          );
        }

        $('form').on('submit', function(){
            var text = $('textarea').val(),
                msg = {message : text};

            socket.send(msg);
            appendMessage(msg);

            $('textarea').val('');

            return false;
        });

        socket.on('message', function(msg) {
          console.log(msg);
            appendMessage(msg);
        });

        // socket.on('message', function(data){
        //   console.log('From server: ', data);
        // }).on('server-info', function(data) {
        //   console.info(data);
        // });

      </script>
    </body>
</html>
