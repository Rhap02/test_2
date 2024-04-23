@extends('main.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Kouta
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Kouta</li>
        </ol>
    </section>
  
    <!-- Main content -->
    <section class="content">
        @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Kouta</h3>
                        <div class="box-tools">
                            <button class="btn btn-primary" onclick="location.reload()">Refresh</button>
                            <button class="btn btn-default" data-toggle="modal" data-target="#createModal">Create</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="bg-success">
                                <tr>
                                    <th>Kouta</th>
                                    <th>Berat Satuan</th>
                                    <th>Harga</th>
                                    <th>Cabang</th>
                                    <th>Create At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($koutas as $item)
                                <tr>
                                    <td>{{ $item->kouta }}</td>
                                    <td>{{ $item->berat }} {{ $item->satuan->satuan }}</td>
                                    <td>Rp. {{ $item->harga }}</td>
                                    <td>{{ $item->cabang }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <button class="btn btn-{{ $item->status == 1 ? 'success' : 'danger' }}" data-toggle="modal" data-target="#statusChangeModal{{ $item->id }}">
                                            {{ $item->status == 1 ? 'Enable' : 'Disable' }}
                                        </button>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#detailModal{{ $item->id }}">Detail</a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#confirmDeleteModal{{ $item->id }}">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                               

                   <!-- Detail Modal -->
                    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="detailModalLabel">Detail Kouta</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('kouta.update', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="kouta">Kouta:</label>
                                            <input type="text" class="form-control" id="kouta" name="kouta" value="{{ $item->kouta }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="berat">Berat:</label>
                                            <input type="text" class="form-control" id="berat" name="berat" value="{{ $item->berat }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga:</label>
                                            <input type="text" class="form-control" id="harga" name="harga" value="{{ $item->harga }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cabang">Cabang:</label>
                                            <input type="text" class="form-control" id="cabang" name="cabang" value="{{ $item->cabang }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan_id">Satuan:</label>
                                            <select class="form-control" name="satuan_id" required>
                                                @foreach ($satuans as $satuan)
                                                    <option value="{{ $satuan->id }}" {{ $satuan->id == $item->satuan_id ? 'selected' : '' }}>{{ $satuan->satuan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                        <!-- Confirm Delete Modal -->
                        <div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="confirmDeleteModalLabel">Yakin Hapus</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin hapus data ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('kouta.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="statusChangeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="statusChangeModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="statusChangeModalLabel">Change Status</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Change status for {{ $item->kouta }} to {{ $item->status ? 'disable' : 'enable' }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ $item->status ? route('kouta.disable', ['id' => $item->id]) : route('kouta.enable', ['id' => $item->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-{{ $item->status ? 'danger' : 'success' }}">{{ $item->status ? 'Disable' : 'Enable' }}</button>
                                        </form>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</section>
                    
                <!-- Create Modal -->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="createModalLabel">Create Kouta</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Add your form for creating Kouta here -->
                                <form action="{{ route('kouta.store') }}" method="POST">
                                    @csrf
                                    <!-- Your form fields go here -->
                                    <div class="form-group">
                                        <label for="kouta">Kouta:</label>
                                        <input type="text" class="form-control" placeholder="Kouta" name="kouta" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="berat">Berat:</label>
                                        <input type="text" class="form-control" placeholder="Berat" name="berat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="satuan_id">Satuan:</label>
                                        <select class="form-control" name="satuan_id" required>
                                            
                                            @foreach ($satuans as $satuan)
                                                <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga:</label>
                                        <input type="text" class="form-control" placeholder="Harga" name="harga" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cabang">Cabang:</label>
                                        <input type="text" class="form-control" placeholder="Cabang" name="cabang" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                                


@endsection
