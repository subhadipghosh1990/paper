<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//database
use DB;

class users extends Controller
{
    //

    function login(Request $req){


        // $users = DB::table('users')
        //         ->where('votes', '=', 100)
        //         ->where('age', '>', 35)
        //         ->get();
        
        //echo session('fname');


        //redirects
        if(session()->has('loggedInUser')){
            return redirect('/user');
        }
        else{
            return view('login');
        }
        //session()->pull('fname',null);
    }


    function user(){
        
        if(session()->has('loggedInUser')){
            return view('user');            
        }
        else{
            return redirect('/login');
        }
    }

    function loginPost(Request $req){

        $users = DB::table('users')
                    ->where('email', '=', $req->input('mail'))
                    ->where('pass', '=', $req->input('pass'))
                    ->get();


            $user = count($users);


            if($user > 0){

                // echo "<pre>";
                // print_r($users[0]->fname);

               $req->session()->put('loggedInUserDetails', $users[0]);
                $req->session()->put('loggedInUser', true);
                return redirect('/');
            }
            else{
                return redirect('/login');
            }

            // $email = $users[0]->email;
            // $img = $users[0]->img;
            // $name = $users[0]->fname." ".$users[0]->lname;
            // $address = $users[0]->address;

            // $loggedInUser = array([
            //     "mail" => $email,
            //     "img" => $img,
            //     "name" => $name,
            //     "address" => $address
            // ]);

            // $req->session()->put('loggedInUserDetails', $loggedInUser);
            // $req->session()->put('loggedInUser', true);

    }

    function signup(){
        

        if(session()->has('loggedInUser')){
            return redirect('/');
        }
        else{
            return view('signup'); 
            
        }

    }

    function signupPost(Request $req){
        //return $req->input();
        // $req->session()->put('fname', $req->input()["fname"]);
        // echo session('fname');

        //{"_token":"NyyVKP3wU8MwXOBpuHUWdupKYoyDT62qKWuRC48R","fname":"Subhadip","lname":"Ghosh","email":"subhadipghosh215@gmail.com","pass":"ss","address":"5\/281, Mahajatinagar","signup":"Register"}

        $first_name = $req->input('fname');
        $last_name = $req->input('lname');
        $email = strval($req->input('email'));
        $pass = $req->input('pass');
        $address = $req->input('address');

        //id	fname	lname	email	pass	phone	address	


        $users = DB::table('users')
                    ->where('email', '=', $req->input('email'))
                    ->get();

        if(count($users) > 0){
            echo "user Already Exists";
        }
        else{

            try{
                DB::table('users')->insert([
                    "fname"=>$req->input('fname'),
                    "lname"=>$req->input('lname'),
                    "email"=>$req->input('email'),
                    "pass"=>$req->input('pass'),
                    "phone"=>$req->input('phone'),
                    "address"=>$req->input('address')
                ]);
        
                return redirect('/login');
            }
            catch (Exception $e){
                echo $e-> getMessage();
            }

        }      
        

    }




    function logout(){
        session()->pull('loggedInUserDetails',null);
        session()->pull('loggedInUser',null);
        return redirect('/');
    }


    function userEdit(Request $req){
        echo "<pre>";
        print_r($req->input());


        // Array
        // (
        //     [_token] => sLGcsIQ9f5je03M3DNB4AxQW9zo1lTJvoYZwV6et
        //     [id] => 1
        //     [fname] => Subhadip
        //     [lname] => Ghosh
        //     [email] => subhadipghosh215@gmail.com
        //     [address] => 5/281, Mahajatinagar
        //     [phone] => +918981568510
        // )

        if($req->file('dp')){

            $file = session()->get('loggedInUserDetails')->img;
            



            if($file == ""){
                
                try {

                    $affected = DB::table('users')
                    ->where('id', '=', $req->input('id'))
                    ->update([
                        "fname"=>$req->input('fname'),
                        "lname"=>$req->input('lname'),
                        "email"=>$req->input('email'),
                        "phone"=>$req->input('phone'),
                        "address"=>$req->input('address'),
                        "img"=>$req->file('dp')->store('userimg')
                    ]);
    
    
                    $users = DB::table('users')
                    ->where('id', '=', $req->input('id'))
                        ->get();
    
    
                    $req->session()->put('loggedInUserDetails', $users[0]);
                    $req->session()->put('loggedInUser', true);
    
                    return redirect("/user");
    
                }              
                catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                }
            

            }

            else{
                try {
                    $del = unlink($file);

                    $affected = DB::table('users')
                    ->where('id', '=', $req->input('id'))
                    ->update([
                        "fname"=>$req->input('fname'),
                        "lname"=>$req->input('lname'),
                        "email"=>$req->input('email'),
                        "phone"=>$req->input('phone'),
                        "address"=>$req->input('address'),
                        "img"=>$req->file('dp')->store('userimg')
                    ]);
    
    
                    $users = DB::table('users')
                    ->where('id', '=', $req->input('id'))
                        ->get();
    
    
                    $req->session()->put('loggedInUserDetails', $users[0]);
                    $req->session()->put('loggedInUser', true);
    
                    return redirect("/user");
    
                }              
                catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                }
            }




        }
        else{
            try{
                $affected = DB::table('users')
                ->where('id', '=', $req->input('id'))
                ->update([
                    "fname"=>$req->input('fname'),
                    "lname"=>$req->input('lname'),
                    "email"=>$req->input('email'),
                    "phone"=>$req->input('phone'),
                    "address"=>$req->input('address')
                ]);
                
                
                $users = DB::table('users')
                ->where('id', '=', $req->input('id'))
                    ->get();


                $req->session()->put('loggedInUserDetails', $users[0]);
                $req->session()->put('loggedInUser', true);

                return redirect("/user");
            }
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

                


    }

}
