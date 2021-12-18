<?php

namespace App\Http\Middleware;

use Closure;
use Auth ;
use App\Role ;
use App\Http\Traits\Admin_sections_traits;

class admin
{
    use Admin_sections_traits;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::guest()) {
            return redirect('admin/login');
        }
        $admin_sections=$this->getAdminSections();
        view()->share('admin_sections', $admin_sections);
        $user=Auth::user();
        if ($user->hasRole(['super_admin','admin','moderator'])) {
            return $next($request);
        }
        else{
            return redirect('/home');
        }

//        if (Auth::guest()) {
//            return redirect('admin/login');
//        }
//        elseif(Auth::user()){
//            $user=Auth::user();
//            if ($user->hasRole('admin')) {
//                return redirect('admin/dashboard');
//            }
//            elseif ($user->hasRole('users_manager')) {
//                return redirect('admin/dashboard');
//            }
//        }
//        else{
//            return redirect('admin/home');
//        }


    }

}
