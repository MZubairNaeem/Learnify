<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'course' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'All fields are required')->withErrors($validator)->withInput();
        }

        $material = new Material();
        $material->title = $request->title;
        $material->course_id = $request->course;
        $material->created_by = auth()->user()->id;
        $material->save();

        //upload file
        if ($request->hasFile('file')) {
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $fileName = str_replace(' ', '', $fileName);
            $path = $request->file('file')->storeAs('material', $fileName, 'public');
            $material->file = $path;
            $material->save();
        }

        return redirect()->back()->with('success', 'Material added successfully');
    }


    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return redirect()->back()->with('success', 'Material deleted successfully');
    }

    public function download($id)
    {
        $material = Material::findOrFail($id);
        return response()->download(storage_path('app/public/' . $material->file));
    }
}
