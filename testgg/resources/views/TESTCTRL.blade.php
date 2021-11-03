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
                    <form action="{{ url('/guser') }}" method="post">
                    @csrf
                    <p style="text-align:center">Please select or add an user : </p>
                    <!-- <p style="text-align:center">    Indicate an user id : <input type="number" class="formu" id="selid" name="selid" min="1" style="width:50px" value="@isset($request){{$request}}@endisset" /> -->
                    
                    </p>  
                    <div class="centrerlebordel">
                        List of users : 
                    <select name="all" style="text-align:center,width:300px" class="formu">
                        @foreach($users as $key => $data)
                            <option value="{{$data->id}}" >    
                                <th>{{$data->id}}</th>
                                <th>{{$data->name}}</th>
                                
                                </br>         
                            </option>
                        @endforeach
                    </select>
                    &nbsp; 
                    <button class="button is-primary" type="submit" name="modif" > Select </button>  &nbsp;
                    <!-- <button class="button is-primary" type="submit" name="modif3" onclick="location.href='{{ url('/adduser') }}'" > Add a new user </button> -->
                    <!-- <a href="{{ url('/adduser')}}" class="button is-primary">Add a new user </a> -->


                    </div>
  
                        </form>


                        <form action="{{ url('/adduser') }}" method="get" >
                        <div class="centrerlebordel">
                        <button class="button is-primary" type="submit" name="modif3" > Add a new user </button>
                        </div>
                        </form>


                        <form action="{{ url('/update') }}" method="post" >
                        @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger"><ul>
                                        @foreach ($errors->all() as $error)
                                         <li>{{ $error }}</li>
                                        @endforeach
                                    </ul></div>
                            @endif

                        @isset($gg)
                        
                            @foreach($gg as $key => $value)
                        
                            @endforeach   
                            </br>
                            
                         <h3 style="margin-left:30px">Modify user number : "{{$value->id}}" </h3>
                         </br>
                            <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l" >
                                <input type="hidden" value="{{$value->id}}" name="hidid"> </input>
                                <p style="margin-left:30px"><label for="name">Name : </label><input type="text" class="formu" id="name" name="name" value=" {{$value->name}}" /></p>
                                <p style="margin-left:30px"><label for="name">Email : </label><input type="text" class="formu" id="email" name="email" value=" {{$value->email}}" /></p>
                                <p style="margin-left:30px"><label for="name">Password : </label><input type="password" class="formu" id="pswd" name="pswd" value=" {{$value->password}}"/></p>
                                <p style="margin-left:30px"><label for="name">Email verified at : </label><input type="text" class="formu" id="email2" name="email2" value=" {{$value->email_verified_at}}" /></p>
                                <p style="margin-left:30px"><label for="name">Password verify : </label><input type="password" class="formu" id="pswd_confirmation" name="pswd_confirmation" value=" {{$value->password}}"/></p>
                                <p style="margin-left:30px"><label for="name">Created at : </label><input type="text" class="formu" id="create" name="create" disabled="disabled" value=" {{$value->created_at}}"/></p>
                                <p style="margin-left:30px"><label for="name">Updated at : </label><input type="text" class="formu" id="update" name="update" disabled="disabled"  value=" {{$value->updated_at}}" /></p>
                                <p style="margin-left:30px"><label for="name">Phone : </label><input type="text" class="formu" id="phone" name="phone" value=" {{$value->phone_number}}"/></p>
                                <p style="margin-left:30px"><label for="name">Active : </label><input type="text" class="formu" id="active" name="active"  value=" {{$value->active}}" /></p>
                                <p style="margin-left:30px"><label for="name">Admin : </label><input type="text" class="formu" id="admin" name="admin" value=" {{$value->is_admin}}" /></p>
                                <p style="margin-left:30px"><label for="name">Location id : </label><input type="text" class="formu" id="location" name="location" value=" {{$value->location_id}}" /></p>
                                <p style="margin-left:30px"><label for="name">Country : </label><input type="text" class="formu" id="country" name="country"  value=" {{$value->country}}" /></p>
                                <p style="margin-left:30px"><label for="name">City : </label><input type="text" class="formu" id="city" name="city" value=" {{$value->city}}" /></p>
                                <p style="margin-left:30px"><label for="name">Postcode: </label><input type="text" class="formu" id="postcode" name="postcode"  value=" {{$value->postcode}}" /></p>
                                <p style="margin-left:30px"><label for="name">Street : </label><input type="text" class="formu" id="street" name="street" value=" {{$value->street}}" /></p>
                                <p style="margin-left:30px"><label for="name">Number : </label><input type="text" class="formu" id="number" name="number"  value=" {{$value->number}}" /></p>
                                <p style="margin-left:30px"><label for="name">Complement : </label><input type="text" class="formu" id="complement" name="complement" value=" {{$value->complement}}" /></p>
                                <p style="margin-left:30px"><button class="button is-primary" type="submit" name="modif2" onclick="return confirm('Confirm modifications ?')"> Validate modification </button></p>
          
                            </div>
                            @else
                            </br>
                            
                            <h3 style="margin-left:30px">Modify user number : "{{old('id')}}" </h3>
                            </br>
                               <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l" >
                                   <input type="hidden" value="{{old('id')}}" name="hidid"> </input>
                                   <p style="margin-left:30px"><label for="name">Name : </label><input type="text" class="formu" id="name" name="name" value=" {{old('name')}}" /></p>
                                   <p style="margin-left:30px"><label for="name">Email : </label><input type="text" class="formu" id="email" name="email" value=" {{old('email')}}" /></p>
                                   <p style="margin-left:30px"><label for="name">Password : </label><input type="text" class="formu" id="pswd" name="pswd" value=" {{old('pswd')}}"/></p>
                                   <p style="margin-left:30px"><label for="name">Email verified at : </label><input type="text" class="formu" id="email2" name="email2" value=" {{old('email2')}}" /></p>
                                   <p style="margin-left:30px"><label for="name">Password verify : </label><input type="text" class="formu" id="pswd_confirmation" name="pswd_confirmation" value=" {{old('pswd_confirmation')}}"/></p>
                                   <p style="margin-left:30px"><label for="name">Created at : </label><input type="text" class="formu" id="create" name="create" disabled="disabled" value=" {{old('create')}}"/></p>
                                   <p style="margin-left:30px"><label for="name">Updated at : </label><input type="text" class="formu" id="update" name="update" disabled="disabled" value=" {{old('update')}}" /></p>
                                   <p style="margin-left:30px"><label for="name">Phone : </label><input type="text" class="formu" id="phone" name="phone" value=" {{old('phone')}}"/></p>
                                   <p style="margin-left:30px"><label for="name">Active : </label><input type="text" class="formu" id="active" name="active"  value=" {{old('active')}}" /></p>
                                   <p style="margin-left:30px"><label for="name">Admin : </label><input type="text" class="formu" id="admin" name="admin" value=" {{old('admin')}}" /></p>
                                   <p style="margin-left:30px"><label for="name">Location id : </label><input type="text" class="formu" id="location" name="location" value=" {{old('location_id')}}" /></p>
                                   <p style="margin-left:30px"><label for="name">Country : </label><input type="text" class="formu" id="country" name="country"  value=" {{old('country')}}" /></p>
                                    <p style="margin-left:30px"><label for="name">City : </label><input type="text" class="formu" id="city" name="city" value=" {{old('city')}}" /></p>
                                    <p style="margin-left:30px"><label for="name">Postcode: </label><input type="text" class="formu" id="postcode" name="postcode"  value=" {{old('postcode')}}" /></p>
                                    <p style="margin-left:30px"><label for="name">Street : </label><input type="text" class="formu" id="street" name="street" value=" {{old('street')}}" /></p>
                                    <p style="margin-left:30px"><label for="name">Number : </label><input type="text" class="formu" id="number" name="number"  value=" {{old('number')}}" /></p>
                                    <p style="margin-left:30px"><label for="name">Complement : </label><input type="text" class="formu" id="complement" name="complement" value=" {{old('complement')}}" /></p>
                                   <p style="margin-left:30px"><button class="button is-primary" type="submit" name="modif2" onclick="return confirm('Confirm modifications ?')"> Validate modification </button></p>
                               </div>
                            @endisset  
                        </form>

                       
    
    </body>
</html>
