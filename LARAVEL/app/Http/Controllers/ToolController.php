<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::where('user_id', Auth::user()->id)->get();

        return view('tools.index', compact('tools'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'description' => ['required', 'min:20'],
            'link' => ['required', 'url'],
            'image' => ['required', 'image', 'max:2048']
        ]);

        $image_path = $request->file('image')->store('icon', 'public');

        $tool = Tool::create([
            'user_id' => Auth::user()->id,
            'name' => $validation['name'],
            'description' => $validation['description'],
            'link' => $validation['link'],
            'slug' => Str::slug($validation['name']) . '-' . substr(Str::uuid(), 0, 8),
            'image' => $image_path
        ]);

        return redirect()->route('home')->with('success', $tool->name . ' has been created!');
    }

    public function show(string $slug)
    {
        $tool = Tool::where('user_id', Auth::user()->id)->where('slug', $slug)->first();

        return view('tools.show', compact('tool'));
    }

    public function update(Request $request, string $slug)
    {
        $tool = Tool::where('user_id', Auth::user()->id)->where('slug', $slug)->first();

        $validation = $request->validate([
            'name' => ['required'],
            'description' => ['required', 'min:20'],
            'link' => ['required', 'url'],
            'image' => ['image', 'max:2048']
        ]);

        if ($validation['name'] == $tool->name) {
            $slug = $tool->slug;
        } else {
            $slug = Str::slug($validation['name']) . '-' . substr(Str::uuid(), 0, 8);
        }

        $image_path = $tool->image;
        if ($request->file('image')) {
            $image_path = $request->file('image')->store('icon', 'public');
        }

        $tool->update([
            'name' => $validation['name'],
            'description' => $validation['description'],
            'link' => $validation['link'],
            'slug' => $slug,
            'image' => $image_path
        ]);

        return redirect()->route('show.tool', ['slug' => $tool->slug])->with('success', $tool->name . ' has been updated!');
    }

    public function delete(Request $request, string $slug)
    {
        $tool = Tool::where('user_id', Auth::user()->id)->where('slug', $slug)->first();
        $name = $tool->name;
        $tool->delete();

        return redirect()->route('home')->with('success', $name . ' has been deleted');
    }
}
