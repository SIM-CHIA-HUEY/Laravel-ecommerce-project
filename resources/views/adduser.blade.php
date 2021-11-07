<!DOCTYPE html>

@include('head')
    <body>
    <header>
        @include('header')
    </header>
            <section id="menu">
                <article id="menuList1">
                </br>
                
                <h1 align="center">User administration </h1>
                    <form action="{{ url('/adduser') }}" method="post">
                    @csrf
                    @if ($errors->any())
                                <div class="alert alert-danger"><ul>
                                        @foreach ($errors->all() as $error)
                                         <li>{{ $error }}</li>
                                        @endforeach
                                    </ul></div>
                            @endif
                    <h3 style="margin-left:30px">Create a new user </h3>
                         </br>
                            <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l" >
                                
                                <p style="margin-left:30px"><label for="name">Name : </label><input type="text" class="formu" id="name" name="name" value="" /></p>
                                <p style="margin-left:30px"><label for="name">Email : </label><input type="text" class="formu" id="email" name="email" value="" /></p>
                                <p style="margin-left:30px"><label for="name">Password : </label><input type="password" class="formu" id="pswd" name="pswd" value=""/></p>
                                
                                <p style="margin-left:30px"><label for="name">Password verify : </label><input type="password" class="formu" id="pswd_confirmation" name="pswd_confirmation" value=""/></p>
                                
                                <p style="margin-left:30px"><label for="name">Phone : </label><input type="text" class="formu" id="phone" name="phone" value=""/></p>
                                <p style="margin-left:30px"><label for="name">Active : </label><input type="text" class="formu" id="active" name="active"  value="" /></p>
                                <p style="margin-left:30px"><label for="name">Admin : </label><input type="text" class="formu" id="admin" name="admin" value="" /></p>
                                <p style="margin-left:30px"><label for="name">Country : </label><input type="text" class="formu" id="country" name="country"  value="" /></p>
                                <p style="margin-left:30px"><label for="name">City : </label><input type="text" class="formu" id="city" name="city" value="" /></p>
                                <p style="margin-left:30px"><label for="name">Postcode: </label><input type="number" class="formu" id="postcode" min="1" name="postcode"  value="" /></p>
                                <p style="margin-left:30px"><label for="name">Street : </label><input type="text" class="formu" id="street" name="street" value="" /></p>
                                <p style="margin-left:30px"><label for="name">Number : </label><input type="number" class="formu" id="number" name="number" min="1" value="" /></p>
                                <p style="margin-left:30px"><label for="name">Complement : </label><input type="text" class="formu" id="complement" name="complement" value="" /></p>
                                <p style="margin-left:30px"><button class="button is-primary" type="submit" name="adding" onclick="return confirm('Confirm creation ?')"> Validate creation ? </button></p>
                            </div>
                    </form> 
                    <a style="margin-left:30px" href="{{ url('/guser')}}" class="button is-primary">Back to user administration </a>
    </body>
</html>