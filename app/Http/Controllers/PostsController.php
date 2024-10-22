<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = DB::table('posts')
        //     ->select('excerpt AS summary', 'description')
        //     ->get();
        
        // $posts_2 = DB::table('posts')
        //     ->select('is_published')
        //     ->distinct()
        //     ->get();
        
        // $posts_3 = DB::table('posts')
        //     ->select('is_published');
        
        // $added3 = $posts_3->addSelect('title')->get();

        # first(): The first() method returns an object. Which can return as arrow notation. 
        # example, $posts->column_name
        # get(): The get() method returns an array. It does not use arrow notation.
        $posts = DB::table('posts')
                   ->where('id', 1)
                   ->first();
        
        # value(): Ese metodo value() permite regresar el valor de algunas de sus columnas. 
        $posts_2 = DB::table('posts')
                     ->where('id', 2)
                     ->value('description');

        # toSql() & toRawSql(): Mostrar la querie del SQL. 
        $posts_3 = DB::table('posts')
                     ->where('id', 3)
                    //  ->toRawSql();
                     ->toSql();
        
        # find(): El metodo find() se usa para regresar un registro por la llave primaria (nada mas)
        # se regresa con el formato object(json).
        $posts_4 = DB::table('posts')
                      ->find(5);
        
        dd($posts_4);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
