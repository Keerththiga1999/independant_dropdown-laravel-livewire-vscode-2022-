<?php

namespace App\Livewire;


use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class CategorySubcategory extends Component
{
    Use WithPagination;
    public $categories;
   

    #[Validate('required|min:3')] 
    public $name;

     #[Validate('required')]
     public $category;

     #[Validate('required')]
     public $subcategory;

     public $subcategories=[];

     public function mount(){
        $this->categories=Category::all();
        $this->subcategories=collect();

     }

     public function updatedCategory($value)
     {
        $this->subcategories=Subcategory::where('category_id',$value)->get();
     }

     public function storeProduct(){
        $this->validate([
            'name'=>'required',
            'subcategory'=>'required'
        ]);
        Product::create([
            'name'=>$this->name,
            'subcategory_id'=>$this->category,
        ]);
        session()->flash('success','Product created successfully');
        
        $this->reset('name','subcategory','category');
     }




     public function render()
     {
         return view('livewire.category-subcategory',[
             'products' => Product::with('subcategory.category')->latest()->paginate(5)
         ]);
     }
}
