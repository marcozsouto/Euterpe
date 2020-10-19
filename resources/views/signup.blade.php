<!DOCTYPE html>
<html >
    <head>
        <title>Sign Up - Euterpe</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    </head>
    <body>
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <div class="box-left"></div>
        <div class="box-right"></div>
        
        <div class="container"></div>
        
        <div class="box-midle">
        <h1>Sign up to start listening.</h1>
        
        <form action="{{route('signup.do')}}" method="post" enctype="multipart/form-data" >
        @csrf
        <div class="line"></div>
            <label class="name" for="name">What's your name?</label>
            <input class="name" type="text" name="name" placeholder="Enter your name."></input>
            </br>
            <label class="email" for="email">What's your email?</label>
            <input class="email" type="text" name="email" placeholder="Enter your email."></input>
            </br>
            <label class="username" for="username">What should we call you?</label>
            <input class="username" type="text" name="username" placeholder="Create a profile name."></input>
            </br>
            <label class="password" for="password" placeholder="Create a password.">Create a password</label>
            <input type="password" name="password"></input>
            </br>
            
            <label class="gender" for="gender">What's your gender?</label>
                <input type="radio" id="male" class ="male" name="gender" value="M">
                <label class ="male" for="male">Male</label>
                <br>
                <input type="radio" id="female" class ="female" name="gender" value="F">
                <label class ="female" for="female">Female</label>
                <br>
                <input type="radio" id="other" class ="other" name="gender" value="N">
                <label class ="other"for="other">Non Binary</label>
            <br>    
            <label class="birthdate" for="birthdate">What's your date of birth?</label>
            <label class="day">Day</label>
            <input class="day" type="text" name="day"placeholder="Day"></input>
            <label class="month">Month</label>
            <select name="month" id="month" placeholder="Month">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">Octobe</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <label class="year">Year</label>
            <input class="year" type="text" name="year" placeholder="YYYY"></input>
            </br>

            <label class="icon-text">Choose a picture for your icon</label>
            <input class="icon" type="file" name="icon" id="icon"/>
            <img class="icon" /> 
            <div class="overlay">
                <label class="icon" for="icon">Add</label></br>
            </div>

            <input type="submit" value="submit"></input>
        </form>
        </div>
        <script>
            $('#icon').next().attr('src',"{{ asset('css/img/person-black-user-shape.png') }}");
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                    $(input).next()
                    .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
                }
                else {
                    var img = input.value;
                    $(input).next().attr('src',img);
                }
            } 

            function iconchange(){
                $('#icon').each(function(index){
                    if ($('#icon').eq(index).val() != ""){
                        readURL(this);
                        $('.hide').show();
                    }
                });
            }

            $('#icon').on("change", function(){
            iconchange();
            });
        </script>

    </body>
</html>