<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    
    public $search;
    public $isOpen = 0;
    public $productId, $name, $description, $price, $quantity;

    public function render()
    {
        return view('livewire.products', [
            'items' => Product::where('name', 'like', '%'.$this->search.'%')->latest()->paginate(5)
        ]);
    }

    public function showModal()
    {
        $this->isOpen = true;
    }

    public function hideModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        // validasi
       $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
       ]);
        // update atau create data
       Product::updateOrCreate(['id' => $this->productId],[
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
       ]);
        // sembunyikan modal
       $this->hideModal();
        // kirim message
       session()->flash('info', $this->productId ? 'Data update success' : 'Data create success');
        // set kembali isi variabel
       $this->productId = '';
       $this->name = '';
       $this->description = '';
       $this->price = '';
       $this->quantity = '';
    }

    public function edit($id)
    {
        // cari data produk
        $item = Product::findOrFail($id);
        // set variabel dengan data produk
        $this->productId = $item->id;
        $this->name = $item->name;
        $this->description = $item->description;
        $this->price = $item->price;
        $this->quantity = $item->quantity;
        // tampil modal
        $this->showModal();
    }

    public function destroy($id){
        // cari dan hapus data produk
        Product::find($id)->delete();
        // kirim message
        session()->flash('delete', 'Data delete success');
    }
}
