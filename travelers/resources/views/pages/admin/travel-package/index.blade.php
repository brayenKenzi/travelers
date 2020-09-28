@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- PAGE UNTUK MENAMBAHKAN PAKET TRAVEL --}}
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
    <a href="{{ route('travel-package.create') }}" class="btn btn-sm btn-primary shadow-sm">
     <i class="fas fa-plus fa-sm text-white-50">Tambah Paket Travel</i>
    </a>
    </div>

    {{-- CARD UNTUK MENAMBAHKAN PAKET TRAVEL --}}
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Departure Date</th>
                            <th>Type</th>
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                            <td>{{ $items->id }}</td>
                                <td>{{ $items->title }}</td>
                                <td>{{ $items->location }}</td>
                                <td>{{ $items->type }}</td>
                                <td>{{ $items->departure_date }}</td>
                                <td>{{ $items->type }}</td>
                                <td>
                                    <a href="{{ route('travel-package.edit', $items->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('travel-package.destroy', $items->id) }}" method="POST" class="d-inline">
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

