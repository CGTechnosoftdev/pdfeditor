<?php

use Illuminate\Database\Seeder;

class EmailTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->truncate();
        $initialData=[[
                'title'=>'Email Verification',
                'slug'=>'email_verification',
                'subject'=>'Email Verification to Register with PDFWriter',
                'place_holders'=>'{[full_name]},{[confirmation_link]}',
                'content'=> '<p>Hi {[full_name]},</p>

                        <p>Welcome to PdfWriter.</p>
                        
                        <p>{[confirmationCode]} is your confirmation code to Verify email</p>

                        <p>Click the below button.</p>
                        
                        <p><a href="{[confirmation_link]}"><input type="submit" value="Verify Email" /> </a></p>
                        
                        <p>Or Copy below URL in your browser.</p>
                        
                        <p>{[confirmation_link]}</p>

                        <p>Thanks for joining with Team PDFWriter</p>',
                'created_by'=>'1',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ],			
        ];
        DB::table('email_templates')->insert($initialData);
    }
}
