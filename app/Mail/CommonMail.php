<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommonMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data=array())
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail_config = config('mail_config.'.($this->data['config_param'] ?? ''));
        if(!empty($mail_config)){
            $from = $this->data['from'] ?? config('mail.from');
            $content_data = $this->data['content_data'] ?? [];
            $search_arr = $replace_arr = [];
            if($mail_config['source'] == 'file'){
                $subject = $this->data['subject'] ?? ($mail_config['subject'] ?? 'Mail from '.env('APP_NAME'));
                $keywords = $mail_config['keywords'] ?? [];
                $content = view('mail.'.$mail_config['key'])->render();
            }
            if(!empty($keywords)){
                foreach($keywords as $word){
                    $key = str_replace(['{[',']}'],['',''],$word);
                    $search_arr[]=$word;
                    $replace_arr[]=$content_data[$key] ?? '';
                }
            }
            $content = str_replace($search_arr, $replace_arr, $content);
            return $this->view('mail.template')
            ->from($from)
            ->subject($subject)
            ->with(['content'=>$content]);
        }
        
    }
}
