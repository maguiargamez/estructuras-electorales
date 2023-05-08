<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Traits\ApiResponser;
use App\Models\StructureCoordinator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanctumAuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:4'
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email']
        ]);

        $structureCoordinator= StructureCoordinator::with('member')->where('id', Auth::user()->structure_coordinator_id)->first();

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken,
            'member' => [
                'id_structure_coodinator'=> $structureCoordinator->id,
                'firstname'=> $structureCoordinator->member->firstname,
                'lastname'=> $structureCoordinator->member->lastname,
                'electoral_key'=> $structureCoordinator->member->electoral_key,
                'section'=> $structureCoordinator->section,
                'goal'=> $structureCoordinator->goal,
            ]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $attr = $request->all();
        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        $abilities= ["*"];
        if(Auth::user()->hasRole('promoter')){
            $abilities= [
                'promoteds:create',
                'promoteds:read',
                'promoteds:update',
                'promoteds:delete',
            ];
        }

        $structureCoordinator= StructureCoordinator::with('member')->where('id', Auth::user()->structure_coordinator_id)->first();

        return $this->success([
            'token' => auth()->user()->createToken(
                    Auth::user()->username,
                    $abilities
                )->plainTextToken,
            'member' => [
                    'id_structure_coodinator'=> $structureCoordinator->id,
                    'firstname'=> $structureCoordinator->member->firstname,
                    'lastname'=> $structureCoordinator->member->lastname,
                    'electoral_key'=> $structureCoordinator->member->electoral_key,
                    'section'=> $structureCoordinator->section,
                    'goal'=> $structureCoordinator->goal,
                ]
        ], 'Sesión iniciada');

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Sesión cerrada'
        ];
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
