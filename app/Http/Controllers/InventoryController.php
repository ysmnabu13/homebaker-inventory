<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Barryvdh\DomPDF\Facade\PDF;


class InventoryController extends Controller
{
    //Show all listings
    public function index(){
        $user = Auth::id();
        $signedInManagerID = Auth::user()->managerID;
        $data = Inventory::where('user_id', $user)->paginate(10); // Retrieve 10 records per page

        return view('inventory.index', [
            'inventory' => $data
        ], compact('signedInManagerID'));
    }

    //Show Create Form
    public function create(){
        return view('inventory.create');
    }

    //Store Inventory Data
    public function store(Request $request, Inventory $inventory){
        $user = auth()->user();
        $formFields = $request->validate([
            'name' =>'required',
            'cost' =>'required',
            'quantity' =>'required',
            'category' =>'required',
            'restockPoint' =>'required'
        ], 
        [
            'name.required' => 'The name field is required.',
            'cost.required' => 'The cost field is required.',
            'quantity.required' => 'The quantity field is required.',
            'category.required' => 'The category field is required.',
            'restockPoint.required' => 'The restocking point field is required.'
        ]);

        $formFields['userID'] = auth()->id();
        $inventory->fill($formFields);

        if ($inventory->quantity > $inventory->restockPoint) {
            $inventory->status = 'In Stock';
        } elseif ($inventory->quantity == 0) {
            $inventory->status = 'Out of Stock';
        } else {
            $inventory->status = 'Stock Running Low';
        }
    
        $inventory->user_id = $user->id;
        $inventory->save();

        session()->flash('success', 'Product added successfully!');
        return redirect('/inventory');
    }  
    
    //Show Edit Form
    public function edit(Inventory $inventory){
        return view('inventory.edit', ['inventory' => $inventory]);
    }
    
    //Update Products in Inventory
    public function update(Request $request, Inventory $inventory){
        $user = auth()->user();
        
        $formFields = $request->validate([
            'name' =>'required',
            'category' =>'required',
            'cost' =>'required',
            'quantity' =>'required',
            'restockPoint' =>'required',
        ], 
        [
            'name.required' => 'The name field is required.',
            'category.required' => 'The category field is required.',
            'cost.required' => 'The cost field is required.',
            'quantity.required' => 'The quantity field is required.',
            'restockPoint.required' => 'The restocking point field is required.'
        ]);

        $inventory->update($request->all());

        if ($inventory) {
            if ($inventory->quantity > $inventory->restockPoint) {
                $inventory->status = 'In Stock';
            } elseif ($inventory->quantity == 0) {
                $inventory->status = 'Out of Stock';
            } else {
                $inventory->status = 'Stock Running Low';
            }
        }
        
        $inventory->user_id = $user->id;
        $inventory->save();

        session()->flash('success', 'Product updated successfully!');
        return redirect('/inventory');
    }
            
    //Delete Product
    public function destroy(Inventory $inventory){        
        $inventory->delete();
        session()->flash('success', 'Product deleted successfully!');
        return redirect('/inventory');
    }

    //Generate Inventory Report in PDF
    public function generateReport(){
        $inventory = Inventory::get();
        $pdf = PDF::loadView('inventory.report', [
            'inventory' => $inventory
        ]);
        return $pdf->download('Inventory Report.pdf');        
    }

    //Update Quantity and Status
    public function updateQuantity($id, Request $request){
    $inventory = Inventory::findOrFail($id);
    $inventory->quantity = $request->input('quantity');
    
    if ($inventory) {
        if ($inventory->quantity > $inventory->restockPoint) {
            $inventory->status = 'In Stock';
        } elseif ($inventory->quantity == 0) {
            $inventory->status = 'Out of Stock';
        } else {
            $inventory->status = 'Stock Running Low';
        }
    }
    $inventory->save();

    return redirect()->back();
    }

    //Search Products
    public function search(Request $request)
    {
        $searchText = $request->input('query');
        $user = Auth::id();
        $signedInManagerID = Auth::user()->managerID;

        $query = Inventory::where('user_id', $user);

        if ($searchText) {
            $query->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('status', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('category', 'LIKE', '%' . $searchText . '%');
            });
        }

        $inventory = $query->paginate(10);

        if ($inventory->isEmpty()) {
            return redirect()->back()->with('warning', 'Product not found.');
        }

        return view('inventory.search', compact('inventory', 'signedInManagerID'));
    }

}
