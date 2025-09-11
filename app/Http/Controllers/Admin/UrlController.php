<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function __construct()
    {
        $this->urls = resolve(ShortUrl::class);
    }
    public function index(Request $request)
    {
        $requestData = $request->all();

        $urls = $this->urls->paginate(10);

        $title = 'Manage URLs';

        return view('admin.urls.list', compact('urls', 'title'));
    }

    public function create()
    {
        $title = 'Generate Short URL';

        return view('admin.urls.add', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required'
        ]);

        $requestData = $request->all();

        $code = Str::random(6);

        ShortUrl::create([
            'user_id' => Auth::guard('admin')->user()->id,
            'original_url' => $requestData['original_url'],
            'code' => $code
        ]);

        return redirect()->route('admin.url.list')->with('success', 'New Short url generated successfully.');
    }

    public function redirect(Request $request)
    {
        $code = $request->route('code');
        
        $shortUrl = ShortUrl::where('code', $code)->first();

        if ($shortUrl && $shortUrl->original_url) {
            return Redirect::to($shortUrl->original_url);
        }

        // Optional: Show a 404 or a custom error page
        abort(404, 'Short URL not found.');
    }
}
