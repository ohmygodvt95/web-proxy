<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Sunra\PhpSimple\HtmlDomParser;


class ProxyController extends Controller
{
    public function proxy(Request $request)
    {
        $response = Http::get($request->input('q'));
        $domain = "https://www.xvideos.com/";
        $html =
            preg_replace_callback(
            '/href=\"\//',
            function ($matches) use ($domain) {
                return "href=\"/proxy?q=$domain";
            },
            $response->body()
        );
        return response($html)->header('Content-Type', 'text/html');
    }
}
