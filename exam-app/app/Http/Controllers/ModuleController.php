<?php

namespace App\Http\Controllers;

use App\Models\module;
use Illuminate\Http\Request;
// use Iluminate\Routing\Controllers\HasMiddleware;
// use Iluminate\Routing\Controllers\Middleware;
use App\Models\UserModule;

class ModuleController extends Controller
{

    // public static function middleware() {

    //     return [
    //         new Middleware('auth:sanctum', except: ['index', 'show'])
    //     ];
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Module::all();
        //return response()->json($modules, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'required'
        ]);

        $module = Module::create($fields);

        return $module; 200;
    }

    /**
     * Display the specified resource.
     */
    public function show(module $module)
    {
        return $module;
    }

    public function activate(Request $request, $id)
    {
        $user = $request->user();
        
        $module = Module::find($id);
        
        if (!$module) {
            return response()->json(['error' => 'Module not found'], 404);
        }

        UserModule::where([
                'user_id' => $user->id,
                'module_id' => $id
            ],
            [
                'active' => false
            ]
        )->update([
                'active' => true
            ]
        );

        return response()->json([
            'message' => 'Module activated'
        ], 200);
    }

    public function deactivate(Request $request, $id)
    {
        $user = $request->user();
        
        $module = Module::find($id);
        
        if (!$module) {
            return response()->json(['error' => 'Module not found'], 404);
        }

        UserModule::where([
                'user_id' => $user->id,
                'module_id' => $id
            ],
            [
                'active' => true
            ]
        )->update([
                'active' => false
            ]
        );

        return response()->json([
            'message' => 'Module deactivated'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, module $module)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'required'
        ]);

        $module->update($fields);

        return $module; 200;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(module $module)
    {
        $module->delete();

        return ['message' => 'The post was deleted'];
    }
}




    



