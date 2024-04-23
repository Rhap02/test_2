@extends('main.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Satuan Unit
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Satuan Unit</li>
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
                        <h3 class="box-title">Satuan Unit</h3>
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
                                    <th>Satuan Unit</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($satuans as $item)
                                <tr>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->desc }}</td>
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
                                              <h4 class="modal-title" id="detailModalLabel">Detail Satuan Unit</h4>
                                          </div>
                                          <div class="modal-body">
                                            <form action="{{ route('satuan.update', ['id' => $item->id]) }}" method="POST">
                                              @csrf
                                              @method('PUT')
                                              <div class="form-group">
                                                  <label for="satuan">Satuan:</label>
                                                  <input type="text" class="form-control" id="satuan" name="satuan" required value="{{ $item->satuan }}">
                                              </div>
                                              <div class="form-group">
                                                  <label for="desc">Deskripsi:</label>
                                                  <textarea class="form-control" id="desc" name="desc" rows="3">{{ $item->desc }}</textarea>
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
                                            <form action="{{ route('satuan.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              
                             <!-- Status Change Modal -->
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
                                                <p>Change status for {{ $item->satuan }} to {{ $item->status ? 'disable' : 'enable' }}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ $item->status ? route('satuan.disable', ['id' => $item->id]) : route('satuan.enable', ['id' => $item->id]) }}" method="POST" style="display: inline;">
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
                    <h4 class="modal-title" id="createModalLabel">Create Satuan Unit</h4>
                </div>
                <div class="modal-body">
                    <!-- Add your form for creating Satuan Unit here -->
                    <form action="{{ route('satuan.store') }}" method="POST">
                        @csrf
                        <!-- Your form fields go here -->
                        <div class="form-group">
                            <label for="satuan">Satuan:</label>
                            <input type="text" class="form-control" placeholder="Satuan" name="satuan" required>
                        </div>
                        <div class="form-group">
                            <label for="desc">Deskripsi:</label>
                            <textarea class="form-control" name="desc" placeholder="Deskripsi" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->


@endsection