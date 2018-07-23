<?php

use Illuminate\Database\Seeder;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\EmailTemplate::class)->create([
            'template_type' => '1',
            'template_name' => 'Order_confirm',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        factory(\App\Models\EmailTemplate::class)->create([
            'template_type' => '1',
            'template_name' => 'Sign_up',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        factory(\App\Models\EmailTemplate::class)->create([
            'template_type' => '1',
            'template_name' => 'merchant_notification',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        factory(\App\Models\EmailTemplate::class)->create([
            'template_type' => '1',
            'template_name' => 'customer_notification',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        factory(\App\Models\EmailTemplate::class)->create([
            'template_type' => '1',
            'template_name' => 'coupon_notification',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

    }
}
