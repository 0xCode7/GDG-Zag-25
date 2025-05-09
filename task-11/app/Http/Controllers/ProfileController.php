<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private array $profiles = [
        1 => ['name' => 'Mahmoud Said', 'age' => 21, 'email' => 'mahmoud@task11.example'],
        2 => ['name' => 'Abdullah hamada', 'age' => 21, 'email' => 'abdullah@task11.example'],
        3 => ['name' => 'Khaled Hisham', 'age' => 22, 'email' => 'khaled@task11.example']
    ];

    public function index()
    {
        return view('profile.explore', ['profiles' => $this->profiles]);
    }

    public function show($id)
    {
        if (!isset($this->profiles[$id])) {
            abort(404);
        }
        return view('profile.show', ['profile' => $this->profiles[$id]]);
    }
}
