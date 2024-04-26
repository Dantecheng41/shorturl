<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\ShortPathService;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shorturl', function (Request $request) {
    $validator = Validator::make($request->query(), [
        'url' => 'required|url:http,https',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $service = new ShortPathService();
    $shotrUrl = $service->findOrCreateShortUrl($request->query('url'));

    return response()->json(['shotr_url' => $shotrUrl], 200);
});

Route::get('/{shortPath}', function ($shortPath) {
    $service = new ShortPathService();
    $originalUrl = $service->findOriginalUrl($shortPath);

    return redirect($originalUrl, 302);
});
