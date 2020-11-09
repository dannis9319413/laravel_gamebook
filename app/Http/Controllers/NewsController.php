<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $all_news = DB::table('news')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.news.list', compact('all_news'));
    }

    public function show()
    {
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request)
    {

        if ($request->hasFile('picture')) {

            $pictureName = $request->picture->getClientOriginalName();

            $request->picture->storeAs('uploads/news', $pictureName, 'public');

            News::create(['picture' => $pictureName, 'title' => $request->title, 'content' => $request->content]);
        } else {

            News::create(['title' => $request->title, 'content' => $request->content]);
        }

        return redirect(route('news.index'))->with('create_success', '新增成功');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, News $news)
    {
        if ($request->hasFile('picture')) {
            if ($news->picture) {
                Storage::delete('public/uploads/news/' . $news->picture);
            }
            $pictureName = $request->picture->getClientOriginalName();
            $request->picture->storeAs('uploads/news', $pictureName, 'public');
            $news->update(['picture' => $pictureName, 'title' => $request->title, 'content' => $request->content]);
        } else {
            $news->update(['title' => $request->title, 'content' => $request->content]);
        }

        $news->update(['title' => $request->title, 'content' => $request->content]);
        return redirect(route('news.index'))->with('update_success', '更新成功');
    }

    public function destroy(News $news)
    {
        $news->delete();
        Storage::delete('public/uploads/news/' . $news->picture);
        return redirect(route('news.index'))->with('delete_success', '刪除成功');
    }
}
