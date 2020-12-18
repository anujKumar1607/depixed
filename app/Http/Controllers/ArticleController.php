<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\User;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Article::all();
        return view('Article.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = 0;
        $message = "error";
        $data = [];
        if(isset($request->title) && isset($request->desc)){
            $article = new Article();
            $article->title = $request->title;
            $article->description = $request->desc;
            $article->save();
            if($article){
                $status = 1;
                $message = "success";
                $data=$article;
            }
        }
        return response()->json(['status'=>$status,'message'=>$message, 'data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if(isset($request->id)){
            $article = Article::find($request->id);
            return response()->json(['status'=>1, 'message'=>'success', 'data'=>$article]);
        }else{
            return response()->json(['status'=>0, 'message'=>'error']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isset($request->title) && isset($request->desc)){

            $article = Article::where('id',$request->id)->update([
                'title'=>$request->title,
                'description'=>$request->desc
            ]);
            $data = Article::find($request->id);
            return response()->json(['status'=>1, 'message'=>'success', 'data'=>$data]);
        }else{
            return response()->json(['status'=>0, 'message'=>'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->id){
            Article::where('id',$request->id)->delete();
            return response()->json(['status'=>1, 'message'=>'success','id'=>$request->id]);
        }
    }
}
