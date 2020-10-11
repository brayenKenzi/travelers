@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- PAGE UNTUK MENAMBAHKAN TRANSAKSI --}}
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
    </div>

    {{-- CARD UNTUK MENAMBAHKAN TRANSAKSI --}}
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr style="background-color: rgba(92, 91, 91, 0.603); color : white;">
                            <th>ID</th>
                            <th>Travel</th>
                            <th>User</th>
                            <th>Visa</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item) 
                        {{-- uraikan semua yang ada di $items menjadi satuan $item --}}
                            <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->travel_package->title }}</td>
                            <td>{{ $item->user->name}}</td>
                            <td>{{ $item->additional_visa }}</td>
                            <td>{{ $item->transaction_total }}</td>
                            <td>{{ $item->transaction_status }}</td>
                            <td class="text-center  d-flex justify-content-around">
                                <a href="{{ route('transaction.show', $item->id) }}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="{{ route('transaction.edit', $item->id) }}" class="btn btn-info">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('transaction.destroy', $item->id) }}" method="POST" class="d-inline">
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

