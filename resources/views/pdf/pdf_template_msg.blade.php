<!DOCTYPE html>
<html>
<head>
    <title>Historique de Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .message {
    padding: 10px;
    margin-bottom: 10px;
    background-color: #e1e1e1;
    border-radius: 5px;
    width: fit-content;
    max-width: 70%;
    word-wrap: break-word;
    box-sizing: border-box;
}

.message-sent {
    background-color: #d1ffd1;
    align-self: flex-end;
    box-sizing: border-box;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Historique de messages entre {{$from['username']}} et {{$to['username']}}</h1>
    
                @foreach($messages as $message)
               
                @if($message['recu'] == true)

                <div class="message">{{$message['msg']['text']}}</div>     <p>{{$message['date']}}</p>


                @else
                <div class="message message-sent">{{$message['msg']['text']}}</div>     <p>{{$message['date']}}</p>

                @endif

                @endforeach
   
    </div>
</body>
</html>
