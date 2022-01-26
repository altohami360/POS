<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $client_id = '';
    public $client_name = '';


    public function render()
    {
        return view('livewire.client.index', [
            'clients' => Client::where('name', 'LIKE', '%' . $this->search . '%')->latest()->paginate(10),
        ]);
    }

    public function deleteClient()
    {
        $client = Client::findOrFail($this->client_id);

        $client->delete();

        session()->flash('message', 'Delete Client Successfully');
    }
    public function setAtt($id, $name)
    {
        $this->client_id = $id;
        $this->client_name = $name;
    }
}
