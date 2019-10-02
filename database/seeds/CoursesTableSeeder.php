<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


    $c1=[
    	'title'=>'Data Structure and Algorithms',
    	'code'=>'CSTE 2201',
    	'semester_id'=>'04'
    ];
    App\Course::create($c1);

    $c11=[
        'title'=>'Data Structure and Algorithms Lab',
        'code'=>'CSTE 2202',
        'semester_id'=>'04'
    ];
    App\Course::create($c11);

    $c2=[
    	'title'=>'Digital Electronics and Pulse Technique',
    	'code'=>'CSTE 2203',
    	'semester_id'=>'04'
    ];
    App\Course::create($c2);

    $c3=[
    	'title'=>'Digital Electronics and Pulse Technique Lab',
    	'code'=>'CSTE 2203',
    	'semester_id'=>'04'
    ];
    App\Course::create($c3);

    $c4=[
    	'title'=>'Electronic Communication',
    	'code'=>'CSTE 3101',
    	'semester_id'=>'05'
    ];
    App\Course::create($c4);


    $c5=[
        'title'=>'Electronic Communication Lab',
        'code'=>'CSTE 3102',
        'semester_id'=>'05'
    ];
    App\Course::create($c5);

    $c6=[
        'title'=>'Computer Networking',
        'code'=>'CSTE 3201',
        'semester_id'=>'06'
    ];
    App\Course::create($c6);

    $c7=[
        'title'=>'Computer Networking Lab',
        'code'=>'CSTE 3202',
        'semester_id'=>'06'
    ];
    App\Course::create($c7);

    $c8=[
        'title'=>'Computer Graphics',
        'code'=>'CSTE 4101',
        'semester_id'=>'07'
    ];
    App\Course::create($c8);
    $c9=[
        'title'=>'Digital Image Processing',
        'code'=>'CSTE 4201',
        'semester_id'=>'08'
    ];
    App\Course::create($c9);


    }
}
