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
     * @OA\Get(
     *     path="/api/tournaments/gender/{gender}",
     *     summary="Get all tournaments",
     *     tags={"Tournaments"},
        *     @OA\Parameter(
        *       name="gender",
        *       in="path",
        *       description="Gender of the tournament",
        *       required=true,
        *       @OA\Schema(
        *         type="string"
        *       )
        *     ),
        *     @OA\Response(
        *       response=200,
        *       description="Success"
        *     )
        * )
    */
    public function gender(String $gender)
    {
        return Tournament::byGender($gender)->latest()->paginate(10);
    }

    /**
     * @OA\Get(
     *     path="/api/tournaments/date/{date}",
     *     summary="Get all tournaments",
     *     tags={"Tournaments"},
        *     @OA\Parameter(
        *       name="date",
        *       in="path",
        *       description="Date of the tournament",
        *       required=true,
        *       @OA\Schema(
        *         type="string"
        *       )
        *     ),
        *     @OA\Response(
        *       response=200,
        *       description="Success"
        *     )
        * )
    */
    public function date($date)
    {
        return Tournament::byDate($date)->latest()->paginate(10);
    }
}