<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LevelModel;

class LevelController extends Controller
{
    // Read
    public function index()
    {
        $data = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar Level yang terdaftar'
        ];

        $activeMenu = 'Level'; //set menu yg sedang aktif

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'data' => $data, 'activeMenu' => $activeMenu]);
    }

    // Create
    public function create()
    {
        $activeMenu = 'Level'; //set menu yg sedang aktif
        $breadcrumb = (object) ['title' => 'Tambah Level', 'list' => ['Home', 'Level', 'Tambah']];

        $page = (object) [
            'title' => 'Tambah Level'
        ];

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        LevelModel::create($request->all());
        return redirect()->route('level.index')->with('success', 'Level created successfully');
    }

    // Edit
    public function edit($id)
    {
        $level = LevelModel::findOrFail($id);
        $activeMenu = 'Level'; //set menu yg sedang aktif
        $breadcrumb = (object) ['title' => 'Edit Level', 'list' => ['Home', 'Level', 'Edit']];
        $page = (object) ['title' => 'Edit Level'];
        return view('level.edit', compact('level', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $level = LevelModel::findOrFail($id);
        $level->update($request->all());
        return redirect()->route('level.index')->with('success', 'Level updated successfully');
    }

    // Delete
    public function destroy($id)
    {
        LevelModel::findOrFail($id)->delete();
        return redirect()->route('level.index')->with('success', 'Level deleted successfully');
    }
}
