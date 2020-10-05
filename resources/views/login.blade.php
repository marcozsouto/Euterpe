<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
    </head>
    <body>
        
        <form action="{{route('login.do')}}" method="post" >
        @csrf
            <label for="username">username</label>
            <input type="text" name="username"></input>
            </br>
            <label for="password">password</label>
            <input type="password" name="password"></input>
            </br>
            <input type="submit" value="submit"></input>
        </form>


    </body>
</html>