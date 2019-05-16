<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

    $u1=[
    	'name'=>'Fazlul Kabir',
    	'email'=>'fazlul@csteoverflow.com',
    	'varsity_id'=>'ASH1501034M',
    	'u_type'=>'Student',
    	'password'=>bcrypt('123456789')
    ];
    $u2=[
    	'name'=>'Hasnat Riaz',
    	'email'=>'hasnat@csteoverflow.com',
    	'varsity_id'=>'TEA1501034M',
    	'u_type'=>'Teacher',
    	'password'=>bcrypt('123456789')
    ];
    $u3=[
    	'name'=>'Dalim Hasan',
    	'email'=>'dalim@csteoverflow.com',
    	'varsity_id'=>'STF1501034M',
    	'u_type'=>'Office Stuff',
    	'password'=>bcrypt('123456789')
    ];

    App\User::create($u1);
    App\User::create($u2);
    App\User::create($u3);

    }
}