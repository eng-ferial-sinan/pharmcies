<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Artisan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides=Slide::orderBy('sort','asc')->get();
        $new_products=Product::latest('created_at')->take(10)->get();
        return view('home',compact('slides','new_products'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function shop(Request $request, $id=0)
    {

        $categories=Category::all();
        $products=Product::latest('created_at');
        $filter = $request->all() ;
        if($id)
        $products=$products->where('category_id',$id);

        if(isset($request->search))
        {
            $search=$request->search;
            $products=$products->where(function ($query) use ($search) {
                $q = '%' . $search . '%';
                return $query->where('name', 'LIKE', $q)
                ->orWhere('price', 'LIKE', $q);
            });
        }
        if(isset($request->sort_by))
        {
        $products=$products->orderBy($request->sort_by);
        }

        if(isset($request->page_long))
        {
        $products=$products->paginate($request->page_long);
        }else
        {
        $products=$products->paginate(6);
        }
        return view('pages.shop',compact('filter','products','categories','id'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addContact(Request $request)
    {
        $data['first_name']=$request->first_name;
        $data['last_name']=$request->last_name;
        $data['email']=$request->email;
        $data['subject']=$request->subject;
        $data['message']=$request->message;
        Contact::create($data);
        return back()->with('success', 'شكرا لتواصلك معنا , سوف يتم الرد الى بريدك الالكتروني في اقرب وقت');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('pages.register');
    }
   
    public function home()
    {
        if(!auth()->user())

        {
            return redirect()->route('login');
        }
        
        return view('admin.vadmin.indexadmin');
    }

}
