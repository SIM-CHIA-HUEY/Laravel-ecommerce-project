<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // à ajouter pour utiliser la DB
use Illuminate\Support\Facades\Hash;

class TESTCTRL extends Controller
{
        //
    public function showAccueil()
    {
        $data = array();
        
        $data["username"] = array();
        $menu = DB::table('users')->get();
        //echo " test AA";
        
        return view('TESTCTRL', ['users' => $menu]);

        //////
    }
    
    


    public function getVariable(Request $request)
    {
        
        
        if(! empty($request->input('all'))) //qd le bouton confirm select est cliqué
        {
            $menu = DB::table('users')->get(); // doit le refaire sinon ça disparait au rechargement
            $results = DB::select('select * from locations inner join users on users.location_id = locations.id where users.id = :id', ['id' => $request->all]);
            //print_r( $results);
            //$resultat = = DB::select('select * from locations where id = :id', ['id' => $request->all]);
            $all = $request->all;
            if($request->submit == "Delete")
            {
                //echo "test 2";
                //print_r($request->all);
                $affected = DB::update(
                    'update users set 
                        active= 0
                         where id ="'. $request->all . '"',
                     
                    
                );
                echo "User has been deleted";
                return view('TESTCTRL', [
                    'request' => $request->all,
                'users' => $menu,
                //'gg' => $results,
            ]);
            }
            else
            {
                //echo "test 3";
            //pour renvoyer toutes les variables
            return view('TESTCTRL', [
                'request' => $request->all,
                'users' => $menu,
                'gg' => $results,
                
            ]);  
            }   
        }
        else
        {
            //echo "le bouton Select ne ramene pas de variable";
        }
        

      //////
    }

    public function setVariable(Request $request)
    {
     // echo "test entree ";  
     // var_dump($request->hidid);
    //if($request->has('modif2'))     
    if(isset($request->name) && !empty($request->name))
    {   
        if(!empty($request->hidid)) //qd le bouton confirm select est cliqué
        {
            //echo "la requete a fonctionné";
            $menu = DB::table('users')->get(); // doit le refaire sinon ça disparait au rechargement
            $results = DB::select('select * from locations inner join users on users.location_id = locations.id where users.id = :id', ['id' => $request->hidid]);
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
            $affected = DB::update(
                'update users set 
            
                    name = "' . strtoupper($request->name) . '", 
                    email="' . $request->email . '",
                    password="' . $request->pswd . '",
                    email_verified_at="' . now() . '",
                    remember_token="' . $request->pswd_confirmation . '",
                    updated_at="' . now() . '",
                    phone_number="' . $request->phone . '",
                    active="' . $request->active . '",
                    is_admin="' . $request->admin . '",
                    location_id="' . $request->location . '"
                     where id = ?',
                [$request->hidid]
                
            );
            $affected2 = DB::update(
                'update locations set 
                    country = "' . strtoupper($request->country) . '", 
                    city="' . strtoupper($request->city) . '", 
                    postcode="' . $request->postcode . '",
                    street="' . $request->street. '",
                    number="' . $request->number . '",
                    complement="' . $request->complement . '"
                     where id = ?',
                [$request->location]
                
            );
            echo " User updated";

            return view('TESTCTRL', [
                'request' => $request->hidid,
                'users' => $menu,
                'locations' => $affected2,
                'gg' => $results,
                
            ]);  
        }
        else //présence du nom mais pas de l'id.
        {
            echo "Modification are not saved, lake of user id.";
            //echo $request->hidid . 'SELID ' . PHP_EOL;
            //echo $request->name . 'NAME' . PHP_EOL;
            //echo "test 3" . PHP_EOL;
        
            //si nom et pas id (après catch d'une erreur (car a vidé les variables du return) reselection avec la name si existe)
            if(isset($request->name))
            {
                $menu = DB::table('users')->get();
                $results = DB::select('select * from users where name = :name', ['name' => $request->name]);
                return view('TESTCTRL', [
                    //'request' => $request->all,
                    'users' => $menu,
                    'gg' => $results,
                    
                ]);
            }
            else //si pas d'id ni de nom retourner au début
            {
                Route::get('/', [TESTCTRL::class, 'showAccueil']);
            }
        }
       
    }
    else
    {
        if(! empty($request->input('all'))) //qd le bouton confirm select est cliqué
        {
            //echo "test 2";
            $menu = DB::table('users')->get(); // doit le refaire sinon ça disparait au rechargement
            $results = DB::select('select * from users where id = :id', ['id' => $request->hidid]);
            //print_r( $results);
           
           
            //pour renvoyer toutes les variables
            return view('TESTCTRL', [
                'request' => $request->hidid,
                'users' => $menu,
                'gg' => $results,
                
            ]);  
        }
        else
        {
           // echo "test 4";
            $data = array();
            $data["username"] = array();
            $menu = DB::table('users')->get();
            
            return view('TESTCTRL', ['users' => $menu]);
        }
    }
}

// public function store(Request $request)
// {

//         $validatedData=$request->validate([
//             'name' => 'required|max:255',
//             'email' => 'required',
//         ]);
// }


}