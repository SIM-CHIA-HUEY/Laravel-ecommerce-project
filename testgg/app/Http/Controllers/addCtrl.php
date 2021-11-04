<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // à ajouter pour utiliser la DB
use Illuminate\Support\Facades\Hash;

class addCtrl extends Controller
{
        //
    public function show()
    {
        //echo "quelque chose";
        return view('/adduser');
        //return redirect()->route('/adduser');
    }

    public function addUser(Request $request)
    {
      //echo "test entree add ";  
      
    //if($request->has('modif2'))     
    if(isset($request->name) && !empty($request->name))
    {   
        
            
            //$menu = DB::table('users')->get(); // doit le refaire sinon ça disparait au rechargement
            //$results = DB::select('select * from users where id = :id', ['id' => $request->hidid]);
            //print_r( $results);
            
            //il vaut mieux le mettre ici car sinon problème de routage. Deux fois post sur la meme route et meme formulaire
            //attention car ça vide les variables
            //pas besoin de if car ça bloque dès que erreur trouvé (== try catch)
            $validatedData=$request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email:rfc,dns',
                'pswd' => 'required|min:8',
                'pswd_confirmation' => 'required|same:pswd',
                'phone' => 'numeric',
                'active' => 'required',
                'admin' => 'required',
                'country'=>'required',
                'city'=>'required',
                'postcode'=>'required',
                'street'=>'required',
                'number'=>'required',
            ]);
            $affected2 = DB::table('locations')->insert([
                'country'=>strtoupper($request->country),
                'city'=>strtoupper($request->city),
                'postcode'=>$request->postcode,
                'street'=>$request->street,
                'number'=>$request->number,
                'complement'=>$request->complement
                    ]);
            $data = array();
            $res = DB::select('select max(id) from locations;');
            foreach($res as $key => $value)
            {
                foreach($value as $dat)
                {
                    $locationid = $dat;
                }
            }
            //print_r( $res);
            //echo $request->res;
            $lastupdated = DATE_FORMAT(now(),'Y-m-d H:i:s');
            $dated = date('Y-m-d');
            $affected = DB::table('users')->insert([
                    'name' => strtoupper($request->name), 
                    'email'=> $request->email,
                    'password'=> Hash::make($request->pswd),
                    'remember_token'=> Hash::make($request->pswd_confirmation),
                    'email_verified_at'=> $lastupdated,
                    //'email_verified_at'=> "'ok'",
                    'updated_at'=> $lastupdated,
                    'created_at'=> $lastupdated,
                    'phone_number'=>$request->phone,
                    'active'=>$request->active,
                    'is_admin'=>$request->admin,
                    'location_id'=>$locationid,
                    ]);
            //$res = DB::select('select max(id) from users;');
            //foreach($res as $ke->$va)
            //{echo $va;
            //}
                    echo "Great " . strtoupper($request->name) . " is saved";

            return view('adduser', [
                'request' => $request->hidid,
                'users' => $affected,
                'locations' => $affected2,
                //'gg' => $results,
                
            ]);  
        
       
    }
    else
    {
        //echo "test 4 " . PHP_EOL;
    }
}



}