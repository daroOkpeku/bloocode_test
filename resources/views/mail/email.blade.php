<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div style="width:100%;">

        <section style="width:30%; display:block; align-item:center; justify-center:center; margin-top:50px;">
           <h2> Welcome {{ $data['lastname'] }} {{ $data['firstname'] }}</h2>

           <h3>please here to verify your email and create your password</h3>
           <a href="{{ url('/user/' . $data['email']) }}">
            <button>Click Here</button>
           </a>
        </section>

    </div>
    
</body>
</html>