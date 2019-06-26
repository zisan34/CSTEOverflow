<?php

use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

    $y=1;
    $t=1;

    for($i=1;$i<5;$i++)
    {    	
	    $y=$i;
	    for($j=1;$j<3;$j++)
	    {
	    	$t=$j;

		    $semester=[
		    	'semester'=>'Y-'.$y.',T-'.$t.''
		    ];
		    App\Semester::create($semester);
	    }



    }



    }
}
