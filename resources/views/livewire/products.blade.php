<div>
    <div class="grid grid-cols-5 gap-4 mt-4">
        <div class="col-start-3 col-end-4">
            <h1 class="text-center font-bold text-xl">Data Product</h1>
        </div>
        <div class="col-start-2 col-end-5">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-start-1 col-end-2">
                    <button wire:click="showModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tambah
                    </button>
                    @if($isOpen)
                        @include('livewire.create')
                    @endif
                </div>
                <div class="col-start-4 col-end-4">
                    <input wire:model="search" type="text" placeholder="search..." class="w-48">
                </div>
            </div>
        </div>
        @if(session()->has('info'))
            <div class="col-start-2 col-end-5">
                <div class="bg-green-400 bg-opacity-70 text-white py-2 px-2 rounded">
                    <h1>{{session('info')}}</h1>
                </div>
            </div>
        @endif
        @if(session()->has('delete'))
            <div class="col-start-2 col-end-5">
                <div class="bg-red-400 bg-opacity-70 text-white py-2 px-2 rounded">
                    <h1>{{session('delete')}}</h1>
                </div>
            </div>
        @endif
    </div>
    <div class="grid grid-cols-5 gap-4">
        <div class="col-start-2 col-end-5">
            <div class="md:container flex flex-col justify-center">
                <div class="bg-white h-full mt-4">
                    <table class="table-fixed w-full">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-2">No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $index=>$item)
                            <tr>
                                <td class="py-2 text-center">{{$index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    <button wire:click="edit({{$item->id}})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-2">
                                        Edit
                                    </button>
                                </td>
                                <td>
                                    <button wire:click="destroy({{$item->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded -mx-10 mt-2">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="py-2">
                                    Data tidak tersedia
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4 mb-3 px-3">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
