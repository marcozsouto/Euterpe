<!DOCTYPE html>
<html >
    <head>
        <title>Sign Up - Euterpe</title>
    </head>
    <body>
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <form action="{{route('signup.do')}}" method="post" enctype="multipart/form-data" >
        @csrf
            <label for="name">name</label>
            <input type="text" name="name"></input>
            </br>
            <label for="username">username</label>
            <input type="text" name="username"></input>
            </br>
            <label for="email">email</label>
            <input type="text" name="email"></input>
            </br>
            <label for="password">password</label>
            <input type="password" name="password"></input>
            </br>
            
            <p>Please select your gender:</p>
                <input type="radio" id="male" name="gender" value="M">
                <label for="male">Male</label>
                <br>
                <input type="radio" id="female" name="gender" value="F">
                <label for="female">Female</label>
                <br>
                <input type="radio" id="other" name="gender" value="N">
                <label for="other">Other</label>
            <br>    
            <label for="birthdate">birthdate</label>
            <input type="date" name="birth"></input>
            </br>
            <label for="icon">icon</label>
            <input type="file" name="icon"></input>
            </br>
            <input type="submit" value="submit"></input>
        </form>


    </body>
</html>