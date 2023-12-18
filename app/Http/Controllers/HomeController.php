<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(){
       $shoProducts = DB::table('products')->get();
      
        return view('home', compact('shoProducts'));
    }

    //Validation
    public function store(Request $request){
        $this->validate($request,[
            'product_ame'=> 'required',
            'price'=> 'required',
            'quantity'=> 'required'
        ]);
       
        //save data
        DB::table('products')->insert([
            'product_ame'=> $request->product_ame,
            'price'=> $request->price,
            'quantity'=> $request->quantity
        ]);
   
        return redirect()->back()->with('success', 'Product create successfully');
    }
//delete
    public function delete ($id){
      
      DB::table('products')->where('id', $id)->delete();
                    
       return back();
    }
//edit
    public function edit (Request $request, $id){
      
      $edit = DB::table('products')->where('id', $id)->first();
      return view('edit', compact('edit'));
                       
      }
//update
    
public function update (Request $request, $id){

    $this->validate($request,[
        'product_ame'=> 'required',
        'price'=> 'required',
        'quantity'=> 'required'
    ]);
      
    $edit = DB::table('products')->where('id', $id)->first();

    $edit->product_ame = $request->product_ame;
    $edit->price       = $request->price;
    $edit->quantity    = $request->quantity;
    
    return redirect('index');
                     
    }


}
