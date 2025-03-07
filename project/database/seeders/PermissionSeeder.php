<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::truncate();
       
        $insavedroutes = ['login', 'register']; 
        $routes = collect(Route::getRoutes())->filter(function ($route) use ($insavedroutes) {
            return !in_array($route->getName(), $insavedroutes);
        });
        foreach ($routes as $route) {
            $name = $route->getName();  
            $methods = $route->methods(); 
            
            if ($name) {
                foreach ($methods as $method) {
                    if (in_array($method, ['GET', 'POST', 'PUT', 'DELETE'])) {
                       
                        $permissionName = strtoupper($method) . ' ' . str_replace('.', ' ', $name);
                        Permission::firstOrCreate([
                            'name' => $permissionName,
                            'route' => $name,
                            'method' => $method,
                        ]);
                    }
                }
            }
        }
    }
}
