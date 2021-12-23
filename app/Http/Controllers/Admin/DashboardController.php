<?php


namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Traits\Admin_sections_traits;

class DashboardController extends Controller
{

    use Admin_sections_traits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

        $this->middleware('permission:Dashboard_Read')->only('index');
//        $this->middleware('permission:dashboard-list')->only('index');
//        $this->middleware('permission:dashboard-create')->only('create','store');
//        $this->middleware('permission:dashboard-edit')->only('edit','update');
//        $this->middleware('permission:dashboard-delete')->only('destroy');
    }

    /**
     * view dashboard page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $lang = session()->get('locale');
//        \App::setlocale(session()->get($lang));
//        return $lang;
        return view('backend/dashboard');
    }



}
