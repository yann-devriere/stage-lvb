<?php 

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{

private $api_key = 'ade395cc79649fa780fecd497b45a07c' ;
private $api_key_secret = 'b41203509819c1e92623d3912c536016';

public function send($to_email , $to_name, $subject, $content)
{

     $mj= new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']); 
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "sedzyk0@gmail.com",
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


public function sendMultiple($contacts , $to_name, $subject, $content)
{

    foreach ($contacts as $contact){

     $mj= new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']); 
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "sedzyk0@gmail.com",
                    'Name' => "Les Volants Berquinois"
                ],

                'To' => [
                    
                    [
                        'Email' => $contact->getemail() ,
                        'Name' => $contact->getemail()
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
}

}


?>