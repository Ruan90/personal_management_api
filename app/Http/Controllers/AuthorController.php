<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * Paginação (/api/author?page=1)
     */
    public function index()
    {
        return Author::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        return Author::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Author::find($id);
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
        $result1 = Author::where('name', 'LIKE', '%' . $keyWord . '%')->get();

        //Retorno da busca pelo campo note da tabela
        $result2 = Author::where('note', 'LIKE', '%' . $keyWord . '%')->get();

        //Junção do retorno dos dois resultados para apresentação como um único resultado
        return $result1->merge($result2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request)
    {

        $author = Author::find($request->id);
        $author->name = $request->name;
        $author->note = $request->note;
        return $author->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Author::destroy($id);
    }
}
