<?php

namespace App\Http\Controllers;

use App\Http\Resources\AiResource;
use App\Models\Ai;
use Illuminate\Http\Request;

class AiController extends Controller
{
    public function index()
    {
        return AiResource::collection(Ai::all());
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'image' => ['required', 'image']
        ]);

        $file = $request->file('image');
        $name = '/images/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['image'] = $name;

        Ai::create($attributes);
    }
}
