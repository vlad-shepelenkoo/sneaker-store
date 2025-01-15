<?php

namespace App\Providers;

use App\Constants;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }


    public function boot(): void
    {
        view()->composer('layouts.admin', function($view){
            $view->with('newMessage',
                Contact::where('read', Constants::UNREAD_MESSAGE)->count());
        });

        view()->composer('layouts.app', function($view){
            $view->with('footer_categories', 
                Category::orderBy('name')->get()->take(4));
            $view->with('footer_brands', 
                Brand::orderBy('name')->get()->take(4));
        });
    }
}
