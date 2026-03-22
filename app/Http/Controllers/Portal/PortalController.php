<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        $studentData = auth()->user()->student;

        return view('portal.profile', compact('studentData'));
    }
    
}
