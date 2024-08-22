<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Envoi;
use App\Models\Groupe;
use App\Models\Groupe_has_message;
use App\Models\Message;
use App\Models\Participe_groupe;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Group;
use Pusher\Pusher;


class MessageController extends Controller
{


    public function showMessage()
    {
        // Récupère l'utilisateur connecté
 
            $user = Auth::user();
        
            // Passe l'utilisateur à la vue
            return view('/home/MessagePage', ['user' => $user]);
   
       
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('username', 'LIKE', "%{$query}%")->get();

        return response()->json($users);
    }
    public function search_discu(Request $request)
    {

        if(str_contains($request->input('fromUser'),"group:")){
            $groupId = explode('group:', $request->input('fromUser'));
            $groupId = $groupId['1'];
            Log::info("INFOO22");
            Log::info($groupId);


            $allMsgGroup = Groupe_has_message::where('groupe_id', $groupId)->get();

            return response()->json($allMsgGroup);

        }
        else{
            $origin = Auth::user();
            $fromUser = $request->input('fromUser');
        
            // Récupérer les messages reçus
            $messageReceive = Envoi::where('User_idReceive', $origin->idUser)
                ->where('User_idSend', $fromUser)
                ->get();
        
            // Récupérer les messages envoyés
            $messageSent = Envoi::where('User_idReceive', $fromUser)
                ->where('User_idSend', $origin->idUser)
                ->get();
        
            // Initialize the $allMessages array
            $allMessages = [];
        
            foreach ($messageReceive as $message) {
                $allMessages[] = $message;
            }
        
            // Ajouter manuellement les messages envoyés au tableau
            foreach ($messageSent as $message) {
                $allMessages[] = $message;
            }
        
            // Trier les messages par date
            usort($allMessages, function ($a, $b) {
                return strtotime($a->date) - strtotime($b->date);
            });
        
            // Ré-indexer le tableau pour éviter des problèmes de clé
            $allMessages = array_values($allMessages);
        
            // Retourner la réponse JSON
            return response()->json($allMessages);
        }
      
    }
    
    


    public function sendMsg(Request $request)
    {

        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
          );
          $pusher = new Pusher(
            '886fe930620d0ca4fab4',
            '9c5512274ef2115168cc',
            '1843242',
            $options
          );
          $eventValue = ['postId'=>'','like'=>''] ;
        $pusher->trigger('message', 'messageReceive', $eventValue);
        

        if(str_contains($request->input('to'),"group:")){
            $groupId = explode('group:', $request->input('to'));
            $groupId = $groupId['1'];
            Log::info("INFOO");
            Log::info($groupId);


            
            $text = $request->input('text');
            $to = $groupId;
            $origin = Auth::user();

            $msg = Message::create([
                'text' => $text,
            ]);

            $originId = $origin->idUser;

            $envoi = Groupe_has_message::create([
                'groupe_id' => $to,
                'message_idmessage' => $msg->idmessage,
                'user_id' => $originId,
            ]);


            
            return response()->json($msg);


        }
        else{


            $validator = Validator::make($request->all(), [
                'text' => 'required|string',
                'to' => 'required|string|exists:users,idUser', // Ensure 'to' is a valid user ID
            ]);
        
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
        
            $text = $request->input('text');
            $to = (int) $request->input('to');
            $origin = Auth::user();
            
    
            Log::info('SendMsg Inputs', ['text' => $text, 'to' => $to, 'origin' => $origin]);
    
            try {
                // Create a new message
                $msg = Message::create([
                    'text' => $text,
                ]);
    
                Log::info('Message Created', ['msg' => $msg]);
                Log::info('Message Created22');
    
                $originId = $origin->idUser;
                $User_idReceive = User::where('idUser', $to)->first()->idUser;
                Log::info($User_idReceive);
                // Associate the message with the sender and receiver
                try{
                    $envoi = Envoi::create([
                        'User_idSend' => $originId,
                        'message_idmessage' => $msg->idmessage,
                        'User_idReceive' => $User_idReceive,
                    ]);
                }
                catch(\Exception $a) {
                    Log::info('Erreur gérée');
                }
               
            
                Log::info('ENVOIE');
               Log::info('Envoi Created', ['envoi' => $envoi]);
        
                return response()->json($msg);
            } catch (\Exception $e) {
                // Log the error and return a generic error message
               
                return response()->json(['message' => 'Failed to send message'], 500);
            }

        }
      


    }
    
    public function getMsg(Request $request)
    {
        $query = $request->input('query');
        $message = Message::where('idmessage', $query)->first();

        return response()->json($message);
    }

    public function createGroup(Request $request)
    {
    
        $group = $request->input('group');
        $name = $request->input('name');
        $origin = Auth::user();

        Log::info('Message group');
        Log::info($group);

        $grp = Groupe::create([
            'name'=> $name
        ]);

        
        $groupList = explode(',', $group);
        Log::info('MAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');

        Participe_groupe::create([
            'user_id'=> $origin->idUser,
            'groupe_id'=> $grp->id

        ]);

        foreach ($groupList as $userGroup) {
     

           
            $intUserGroup = (int) $userGroup;

            Participe_groupe::create([
                'user_id'=> $intUserGroup,
                'groupe_id'=> $grp->id

            ]);


        }

        return response()->json(1);
    }
    

    public function searchGroupsUser(Request $request){

        $user = Auth::user();

        $groupList = Participe_groupe::where('user_id', $user->idUser)
            ->get();

        return response()->json($groupList);

    }

    public function getGroupFromParticipate(Request $request){

        $groupid = $request->input('groupId');

        $group = Groupe::where('id', $groupid)
            ->first();

        return response()->json($group);

    }
}
