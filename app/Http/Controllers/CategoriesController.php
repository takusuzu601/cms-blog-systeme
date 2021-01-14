<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
 
    public function index()
    {
         return view('categories.index')->with('categories',Category::all());
    }

    
    public function create()
    {
          return view('categories.create');
    }

   
    public function store(CreateCategoryRequest $request)
    {

          Category::create([
            'name'=>$request->name
          ]);

          session()->flash('success','カテゴリーを登録しました。');

          return redirect(route('categories.index'));
    }


    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('categories.create')->with('category',$category);
    }


    public function update(UpdateCategoriesRequest $request , Category $category)
    {
         $category->update([
             'name'=>$request->name
         ]);

         $category->save();

         session()->flash('success','カテゴリーを更新しました。');

         return redirect(route('categories.index'));
    }

    public function destroy(Category $category)
    {
        if($category->posts->count()>0){
            session()->flash('error','投稿がありますので削除できません');
            return redirect()->back();
        }
        $category->delete();
        session()->flash('success','カテゴリーを削除しました');
        return redirect(route('categories.index'));
    }
}
