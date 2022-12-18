<?php

namespace App\Http\Controllers;

use App\Models\Tournament;

/**
 * Class TournamentController
 * Get all tournaments of men
 * @package App\Http\Controllers
 */
class TournamentByController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gender(String $gender)
    {
        return Tournament::byGender($gender)->latest()->paginate(10);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function date($date)
    {
        return Tournament::byDate($date)->latest()->paginate(10);
    }
}