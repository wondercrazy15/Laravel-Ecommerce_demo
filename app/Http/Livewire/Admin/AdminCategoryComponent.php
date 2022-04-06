<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layouts('layouts.base');
    }
}
