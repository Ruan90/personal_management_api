<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::find($id);
    }

    /**
     * Display the specified resource by key word.
     * 
     * @param  $keyWord
     * @return \Illuminate\Http\Response
     */
    public function showByKeyWord($keyWord)
    {
        //Retorno da busca pelo campo name da tabela
        $result1 = Category::where('name', 'LIKE', '%' . $keyWord . '%')->get();

        //Retorno da busca pelo campo note da tabela
        $result2 = Category::where('note', 'LIKE', '%' . $keyWord . '%')->get();
        
        //Junção do retorno dos dois resultados para apresentação como um único resultado
        return $result1->merge($result2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->color = $request->color;
        $category->note = $request->note;
        return $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Category::destroy($id);
    }
}
