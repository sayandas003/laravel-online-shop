<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){

    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $validator= Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

        $customMessages = [
            'name.required' => 'The name field is required.',
            'slug.required' => 'The slug is required.',
            'slug.unique' => 'The slug has already been taken.'
        ];
        $validator->setCustomMessages($customMessages);
    
        $name = $request->name;
        $slug = $request->slug;
        $status = $request->status;

        if($validator->passes()){
            $category = new Category;
            $category['name'] = $name;
            $category['slug'] = $slug;
            $category['status'] = $status;
            $category->save();

            $request->session()->flash('success', 'Category added successfully');

            return redirect()->back()->with('success', 'Category added successfully');
        }
        else{

            return redirect()->back()->withErrors($validator)->withInput();
        }
        
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
