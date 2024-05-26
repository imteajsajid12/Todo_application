<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About project

### clone the project

```
 https://github.com/imteajsajid12/Todo_application.
 
```
### Run

````
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php83-composer:latest \
composer install --ignore-platform-reqs

````
### OR 
```php
composer install --ignore-platform-req

```

```php

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan serve


http://localhost/todo
```
## Controller

````php

<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Todo::get();
       $incomplete= $data->where('status','0')->count('status');
       $complete= $data->where('status','1')->count('status');


        return view('Todo.index',[
            'todos' => $data,
            'incomplete' => $incomplete,
            'complete' => $complete
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable|max:255',
            ]);
            Todo::create($validatedData);
            return to_route('todo.index')->with('success', 'Todo created successfully.');
        }
        catch (\Exception $e) {
            return to_route('todo.index')->with('error', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return response()->json($todo,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
       return response()->json($todo,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
        ]);

        $todo->update($validatedData);
        return to_route('todo.index')->with('success', 'Todo updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return to_route('todo.index')->with('success', 'Todo deleted successfully.');
    }

    public function status ($id)

    {
        $todo = Todo::find($id);
        $todo->status == 1 ? $todo->update(['status' => 0]) : $todo->update(['status' => 1]);

        return to_route('todo.index')->with('success', 'Todo updated successfully.');
    }
}
````


## views


### recources/view/Todo


## Route

### web.php 


## URL
 ```php
 http://localhost/todo
 ```
