<?php

namespace App\Http\Controllers;

use App\Events\PostLiked;
use App\Models\Avis;
use App\Models\Commentaire;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;


class PostController extends Controller
{
    
    public function likePost(Request $request)
    {
 
        
    


        $postId = $request->input('postId');
        $user = Auth::user();

        $avisActu = Avis::where('user_id', $user->idUser)
                ->where('post_id', $postId)
                ->first();

        if (is_null($avisActu)) {//avis existe pas

            $avisActu = Avis::create([
                'user_id' => $user->idUser,
                'post_id' => $postId,
                'like' => 1,
                'repost' => 0,
            ]);
            
        }
        else{
 
            $likeActu = $avisActu->like;
            $newLike = $likeActu!=1?1:0;
    
            Avis::where('user_id', $user->idUser)
            ->where('post_id', $postId)
            ->update(['like' =>$newLike]);
    
        }


        
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
        
          $eventValue = ['postId'=>$postId,'like'=>$newLike] ;

          $pusher->trigger('posts', 'likeCount', $eventValue);



     

        return response()->json($newLike);
   
       
    }

    public function dislikePost(Request $request)
    {
 

        $postId = $request->input('postId');
        $user = Auth::user();

        $avisActu = Avis::where('user_id', $user->idUser)
                ->where('post_id', $postId)
                ->first();

        if (is_null($avisActu)) {//avis existe pas

            $avisActu = Avis::create([
                'user_id' => $user->idUser,
                'post_id' => $postId,
                'like' => -1,
                'repost' => 0,
            ]);

            //inverser la valeur de like

            
        }
        else{

            $likeActu = $avisActu->like;
            $newLike = $likeActu!=-1?-1:0;
    
            Avis::where('user_id', $user->idUser)
            ->where('post_id', $postId)
            ->update(['like' =>$newLike]);
        }



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
        
          $eventValue = ['postId'=>$postId,'like'=>$newLike] ;

          $pusher->trigger('posts', 'likeCount', $eventValue)->toOthers();;
        


        return response()->json($newLike);
   
       
    }

    
    public function UserLiked(Request $request)
    {
 

        $postId = $request->input('postId');
        $user = Auth::user();

        $avisActu = Avis::where('user_id', $user->idUser)
                ->where('post_id', $postId)
                ->first();

        if (is_null($avisActu)) {//avis existe pas

            $avisActu = Avis::create([
                'user_id' => $user->idUser,
                'post_id' => $postId,
                'like' => 0,
                'repost' => 0,
            ]);

            //inverser la valeur de like

            
        }

        
        $likeActu = $avisActu->like;


        return response()->json($likeActu);
   
       
    }



    public function nbLikePostUser(Request $request)
    {
 

        $postId = $request->input('postId');
        $user = Auth::user();


        $avisUser = Avis::where('post_id', $postId)
                ->where('user_id', $user->idUser)
                ->first();

        if (is_null($avisUser)) {//0 avis = 0 likes

            return response()->json(0);
            
        }
        else{
            return response()->json($avisUser->like);
        }
       
    }

    
    public function nbLikePost(Request $request)
    {
 

        $postId = $request->input('postId');

        $allAvis = Avis::where('post_id', $postId)
                ->get();

        if (is_null($allAvis)) {//0 avis = 0 likes

            return response()->json(0);
            
        }

  
        //calculer nb likes

        $nblikes = 0;
        foreach ($allAvis as $avis) {
            $nblikes = $nblikes + $avis->like;
        }

        return response()->json($nblikes);
   
       
    }

    
    public function deletePost(Request $request)
    {
 

        $postId = $request->input('postId');
        $user = Auth::user();


        $postUser = Post::where('idpost', $postId)
                ->where('User_idUser', $user->idUser)
                ->first();

        if (is_null($postUser)) {//0 avis = 0 likes

            Log::info('PAS DE CORRESP');
            Log::info( $user->idUser);

            Log::info($postId);
            Log::info($postUser);


            return response()->json(0);
            
        }
        else{
            Log::info('OUIOUIOUI');

            $allAvis = Avis::where('post_id', $postId)
            ->get();

            Log::info('2');
            Log::info($allAvis);


            foreach ($allAvis as $avis) {
                $allCommentaires = Commentaire::where('avis_post_id', $postId)
                ->get();
                Log::info('3');
                Log::info($allCommentaires);
    
                foreach ($allCommentaires as $commentaire) {
                    Log::info('4');

                    Commentaire::where('avis_post_id', $commentaire->avis_post_id)
                    ->delete();
                }
                Log::info('5');

                Avis::where('post_id', $avis->post_id)
                ->delete();
            }
            Log::info('6');

            Post::where('idpost', $postId)
                ->where('User_idUser', $user->idUser)
                ->delete();
                Log::info('7');

            return response()->json(1);
        }
       
    }



  
    public function commentPost(Request $request)
    {


 
        Log::info('AAAA');

        $postId = $request->input('postId');
        $comment = $request->input('comment');
        $user = Auth::user();

        Log::info('BBB '. $postId . ' ' . $user->idUser);


        $avisActu = Avis::where('user_id', $user->idUser)
                ->where('post_id', $postId)
                ->first();

                Log::info('CCC');
        if (is_null($avisActu)) {//avis existe pas

            Log::info('DDD');
            $avisActu = Avis::create([
                'user_id' => $user->idUser,
                'post_id' => $postId,
                'like' => 0,
                'repost' => 0,
            ]);
            Log::info('EEE');

            
        }


        //add commentaire
        Log::info('FFF');
        $commentaire = Commentaire::create([
            'avis_user_id' => $avisActu->user_id,
            'avis_post_id' => $avisActu->post_id,
            'text' => $comment,
        ]); 

        Log::info('GGG');
       

        return response()->json(1);
   
       
    }


    
    public function getAllCommentPost(Request $request)
    {
 

        $postId = $request->input('postId');


        $allComments = Commentaire::where('avis_post_id', $postId)
                ->get();
       

        return response()->json($allComments);
   
       
    }


    
    
    public function addUsersToChannel(Request $request)
    {
 

       
    }




}
