<?php

namespace App\Http\Controllers;

use App\Models\Envoi;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {



        $to = (int) $request->input('to');
        $toObjet = User::where('idUser',$to)->first();
        $from = Auth::user();

        
        Log::info('INSIE');
        Log::info($to);

        $messageReceive = Envoi::where('User_idReceive', $from->idUser)
        ->where('User_idSend', $to)
        ->get();

    // Récupérer les messages envoyés
    $messageSent = Envoi::where('User_idReceive', $to)
        ->where('User_idSend', $from->idUser)
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
    
        Log::info('Before');
        // Ré-indexer le tableau pour éviter des problèmes de clé
        $allMessages = array_values($allMessages);


    $allMessagesText = [];
    foreach ($allMessages as $message) {
        $messageText = Message::where('idmessage', $message->message_idmessage)->first();

        // Ajouter au tableau associatif
        $allMessagesText[] = [
            'msg' => $messageText,
            'date' => $message->date,
            'recu' => ($message->User_idReceive == $from->idUser)
        ];    }





        $messages = $allMessagesText;
        $dompdf = new Dompdf();
        $data = ['messages' => $messages,'to' => $toObjet,'from' => $from];
        $html = view('pdf.pdf_template_msg', $data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        Log::info('After');
        return $dompdf->stream('document.pdf');
    }
}
