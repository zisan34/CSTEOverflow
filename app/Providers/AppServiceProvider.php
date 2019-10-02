<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema; //NEW: Import Schema


use Illuminate\Support\Collection;



use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Pagination\Paginator;


use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191); //NEW: Increase StringLength




        //collection pagination
        if (!Collection::hasMacro('paginate')) {

        Collection::macro('paginate', 
            function ($perPage = 15, $page = null, $options = []) {
            $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
            return (new LengthAwarePaginator(
                $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                ->withPath('');
            });
        }

        view()->share('popular_tags',DB::table('post_tag')
                     ->select(DB::raw('count(tag_id) as repetition, tag_id'))
                     ->groupBy('tag_id')
                     ->orderBy('repetition', 'desc')
                     ->get()->take(5));
        view()->share('semesters',\App\Semester::all());
        view()->share('tags',\App\Tag::all());
    }
}
