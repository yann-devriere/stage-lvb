<?php 

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{


public function send($to_email , $to_name, $subject, $content)
{

     $mj= new Client($_ENV['MJ_APIKEY_PUBLIC'], $_ENV['MJ_APIKEY_PRIVATE'],true,['version' => 'v3.1']); 
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "les.volants.berquinois@gmail.com",
                    'Name' => "Les Volants Berquinois"
                ],
                'To' => [
                    [
                        'Email' => $to_email ,
                        'Name' => $to_name,
                    ],
                    
                    
                ],
                'TemplateID' => 3538596,
                'TemplateLanguage' => true,
                'Subject' => $subject,
                'Variables' => [
                    'content' => $content
                ]
            ]
        ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success();
}




public function sendMultiple($to,$subject,$content)
{

     $mj= new Client($_ENV['MJ_APIKEY_PUBLIC'], $_ENV['MJ_APIKEY_PRIVATE'],true,['version' => 'v3.1']); 
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "les.volants.berquinois@gmail.com",
                    'Name' => "Les Volants Berquinois"
                ],
                'To' => $to    ,
                'TemplateID' => 3898269,
                'TemplateLanguage' => true,
                'Subject' => $subject,
                'Variables' => [
                    'sujet'=>$subject,
                    'content' => $content,
                ]
            ]
        ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success()  ;
}


}




?>