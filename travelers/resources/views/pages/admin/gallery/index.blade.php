@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- PAGE UNTUK MENAMBAHKAN GALLERY --}}
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Gallery</h1>
    <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary shadow-sm">
     <i class="fas fa-plus fa-sm text-white-50">Tambah Gallery</i>
    </a>
    </div>

    {{-- CARD UNTUK MENAMBAHKAN GALLERY --}}
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Travel</th>
                            <th>Gambar</th>
                            <th>Action</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item) 
                        {{-- uraikan semua yang ada di $items menjadi satuan $item --}}
                            <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->travel_package->title }}</td>
                            {{-- untuk memanggilan relasi travel_package yang berada di model Gallery --}}
                            <td>
                                <img src="{{ Storage::url($item->image) }}" alt="" style="width: 100px" class="img-thumbnail" />
                                {{-- sebelumnya harusa jalankan : php artisan storage:link | agar folder storage bisa diakses di public & gambarnya bisa muncul--}}
                            </td>
                            <td>
                                <a href="{{ route('gallery.edit', $item->id) }}" class="btn btn-info">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('gallery.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td> 
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center"> 
                                    {{-- colsapn 7 untuk mengambil 7 column di jadikan 1 --}}
                                    Data Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</div>
  <!-- /.container-fluid --> 
    
@endsection

