<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class testController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api'); 
    }

    public function getRoles()
    {
        try
        {
            return Role::all();
        }
        catch(Exception $e)
        {
            return 
            [
                "status" => 0,
                "description" => "Exception",
                "message" => $e->getMessage()
            ];
        }
    }
}
