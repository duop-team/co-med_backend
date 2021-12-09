<?php

namespace App\Http\Controllers;

use App\Models\NewsRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsRecord::all();
        return $news;
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id == 4) {
            return response(null, 403);
        }

        $record = NewsRecord::create([
            'title' => $request->title,
            'longtitle' => $request->longtitle,
            'text' => $request->text,
            'user_id' => $request->author
        ]);

        return response($record, 201);
    }

    public function show(NewsRecord $record)
    {
        return response($record);
    }

    public function destroy(NewsRecord $record)
    {
        if (Auth::user()->role_id == 4) {
            return response(null, 403);
        }

        if ($record->delete()) {
            return response(null, 204);
        }
    }

    public function update(Request $request, NewsRecord $record)
    {
        if (Auth::user()->role_id == 4) {
            return response(null, 403);
        }

        $post = $record->update([
            'title' => $request->title,
            'longtitle' => $request->longtitle,
            'text' => $request->text
        ]);

        return response($record, 201);
    }
}
