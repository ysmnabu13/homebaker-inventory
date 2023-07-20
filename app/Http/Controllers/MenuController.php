<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //Show all menus
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::id();
            $data = Menu::where('user_id', $user)->paginate(8);
        } else {
            $data = Menu::paginate(8);
        }

        return view('menu.index', ['menu' => $data]);
    }

    //Show menu's recipe
    public function recipe($menu){
        $recipe = Menu::where('id', $menu)->first();
        return view('menu.recipe', [
            'menu' => $recipe
        ]);
    }

    //Show Create Form
    public function create()
    {
        $userId = auth()->id();
        $inventory = Inventory::where('user_id', $userId)->get();
        $ingredientIds = $inventory->pluck('id')->toArray();
        $ingredientString = implode(',', $ingredientIds);
    
        return view('menu.create', ['inventory' => $inventory, 'ingredientString' => $ingredientString]);
    }

    //Search Menu
    public function search(Request $request)
    {
        $searchText = $request->input('query');

        if ($searchText) {
            $menu = Menu::where(function($query) use ($searchText) {
                $query->where('name', 'LIKE', '%'.$searchText.'%')
                    ->orWhere('category', 'LIKE', '%'.$searchText.'%');
            })->paginate(8);

            if ($menu->isEmpty()) {
                return redirect()->back()->with('warning', 'Menu not found.');
            }        
        }
        else {
            $menu = Menu::paginate(8);
        }
        
        return view('menu.search', compact('menu'));
    }

    //Store Menu Data
    public function store(Request $request){
        $user = auth()->user();
        $request->validate([
            'name' =>'required',
            'price' =>'required',
            'category' =>'required',
            'ingredients' =>'required',
            'recipe' =>'required'
        ], 
        [
            'name.required' => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'category.required' => 'The category field is required.',
            'ingedients.required' => 'The ingredients field is required.',
            'recipe.required' => 'The recipe field is required.'
        ]);

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->category = $request->category;
        $menu->ingredients = json_encode($request->ingredients);
        $menu->recipe = $request->recipe;
        if($request->hasFile('photo')){
            $menu['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $menu->user_id = $user->id;
        $menu->save();

        session()->flash('success', 'Menu listing created successfully!');
        return redirect('/menu');
    }  

    //Show Edit Form
    public function edit(Menu $menu){
        $userId = auth()->id();
        $inventory = Inventory::where('user_id', $userId)->get();
        $ingredientIds = $inventory->pluck('id')->toArray(); // Get an array of ingredient IDs
        $ingredientString = implode(',', $ingredientIds);

        return view('menu.edit', ['menu' => $menu], ['inventory' => $inventory, 'ingredientString' => $ingredientString]);
    }
    
    //Update Listing Data
    public function update(Request $request, Menu $menu){
        
        $formFields = $request->validate([
            'name' =>'required',
            'price' =>'required',
            'category' =>'required',
            'ingredients' =>'required',
            'recipe' =>'required'
        ], 
        [
            'name.required' => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'category.required' => 'The category field is required.',
            'ingedients.required' => 'The ingredients field is required.',
            'recipe.required' => 'The recipe field is required.'
        ]);

        if($request->hasFile('photo')){
            $formFields['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $menu->update($formFields);

        session()->flash('success', 'Menu updated successfully!');
        return redirect('/menu');
    }
        
    //Delete Listing
    public function destroy(Menu $menu){        
        $menu->delete();

        session()->flash('success', 'Menu deleted successfully!');

        return redirect('/menu');
    }
    
    //Show Menu Cost
    public function cost($menu)
    {
        $userId = auth()->id();
        $cost = Menu::where('id', $menu)->first();
        $inventory = Inventory::where('user_id', $userId)->get();
        
        return view('menu.show-cost', [
            'menu' => $cost,
            'inventory' => $inventory,
        ]);
    }
}