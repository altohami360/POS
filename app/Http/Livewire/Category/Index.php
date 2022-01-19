<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $name = '';
    public $Category_id = '';

    public $editMode = false;

    public function render()
    {
        $categories = Category::where('name', 'LIKE', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.Category.index', [
            'categories' => $categories,
        ]);
    }
    public function setAtt($id, $name)
    {
        $this->Category_id = $id;
        $this->name = $name;
    }
    public function destory()
    {
        $Category = Category::find($this->Category_id);
        $Category->delete();
        $this->reset(['name', 'Category_id']);
        session()->flash('message', 'Delete Category Successfully');
    }
    public function store()
    {
        if ($this->editMode) {

            $this->validate(['name' => 'required']);
            $Category = Category::find($this->Category_id);
            $Category->update([
                'name' => $this->name,
            ]);

            $this->reset(['name', 'Category_id']);
            $this->editMode = false;
            session()->flash('message', 'Update Category Successfully');
        } else {

            $this->validate(['name' => 'required|unique:categories']);
            Category::create([
                'name' => $this->name,
                'active' => true,
            ]);
            $this->reset(['name', 'Category_id']);
            session()->flash('message', 'Add Category Successfully');
        }
    }

    public function edit($id, $name)
    {
        $this->Category_id = $id;
        $this->name = $name;
        $this->editMode = true;
    }
}
