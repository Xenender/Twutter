<?php

namespace App\Http\Controllers;

use App\Models\Envoi;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\MailClass;


class UserController extends Controller
{
     /**
     * Handle the creation of a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:45',
            'email' => 'required|string|email|max:45|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function allUsers(Request $request){

        $users = User::all(); 

        return response()->json($users);


    }

    /**
     * Handle the login of a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request){


          // Validate the request data
          $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:45',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Authenticate the user
            Auth::login($user);

            return response()->json(['message' => 'Login successful', 'user' => $user], 200);
        } else {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }


    }

    public function showProfile()
    {
    
            $user = Auth::user();

            $postsUser = Post::where('User_idUser', $user->idUser)->get();
        
            // Passe l'utilisateur à la vue
            return view('/home/ProfilPage', ['user' => $user,'postsUser'=>$postsUser]);
       
       
       
    }



    public function showSettings()
    {
        // Récupère l'utilisateur connecté
   
            $user = Auth::user();
        
            // Passe l'utilisateur à la vue
            return view('/home/SettingsPage', ['user' => $user]);
        }
    
       
    

    public function sendPost(Request $request)
    {
        // Récupère l'utilisateur connecté
     
            $user = Auth::user();
            $textPost = $request->text;


            $post = Post::create([
                'text' => $textPost,
                'User_idUser' => $user->idUser,
            ]);


        
            // Passe l'utilisateur à la vue
            return redirect('/profil');
       
       
    }
    
    public function showHome()
    {
        // Récupère l'utilisateur connecté
        if (auth()->check()) {
            $users = User::all();
        
            $posts = Post::all();

            // Passe l'utilisateur à la vue
            return view('/home/HomeConnectedPage',['users'=>$users,'posts' => $posts]);
        }
        else{
            return view('/hub/HubPage');
        }
       
    }

    public function sendEmail(Request $request)
    {

        $nom = $request->input('nom');
        $objet = $request->input('objet');
        $message = $request->input('message');
        $user = Auth::user();

        $details = [
            'title' => $objet,
            'name' => $nom,
            'body' => $message
        ];

        Mail::to($user->email)->send(new MailClass($details));

        return "Email Sent";
    }


      
    public function getUsernameFromId(Request $request)
    {
 

        $userId = $request->input('userId');


        $user = User::where('idUser', $userId)
                ->first();
       

        return response()->json($user);
   
       
    }



    ///


    public function showUserHome(Request $request)
    {
 

        return view('/templates/userHome');
       
    }

    
}
