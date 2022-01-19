<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $user_id;
    public $user_name;
    // public $user;

    public function render()
    {
        $users = User::where('first_name', 'LIKE', '%' . $this->search . '%')
            ->OrWhere('last_name', 'LIKE', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.user.index', [
            'users' => $users,
        ]);
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->user_id);

        if (File::exists('storage/' . $user->image)) {
            File::delete('storage/' . $user->image);
        }

        $user->delete();

        session()->flash('message', 'Delete User Successfully');
    }

    public function setAtt($id, $name)
    {
        $this->user_id = $id;
        $this->user_name = $name;
    }
}
