<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(): View
    {
        $files = File::latest()->get();
        return view('index', compact('files'));
    }

    public function store(FileRequest $request): RedirectResponse
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $ext = $request->file->extension();
            $doc = file_get_contents($path);
            $base64 = base64_encode($doc);
            $size = $request->file('file')->getSize();

            $mime = $request->file('file')->getClientMimeType();

            File::create([
                'name' => "$request->name.$ext",
                'file' => $base64,
                'mime' => $mime ,
                'size' => $size
            ]);
        }
        return back()->with('success', 'Arquivo enviado com sucesso!');
    }
}
