@extends('layouts.app')

@push('title')
    Project
@endpush

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Project</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ url('/project/filter') }}" class="row align-items-end">
                <div class="col-md-1">
                    <h2 style="font-size: 20px; font-weight: 700;">Filter</h2>
                </div>
                <div class="col-md-5 form-group mb-0">
                    <label class="form-label">Project Name</label>
                    <input type="text" name="searchData" class="form-control" value="{{ \Request::get('searchData') }}">
                </div>
                <div class="col-md-2 form-group mb-0">
                    <label class="form-label">Client</label>
                    <select name="clientData" class="form-control">
                        <option value="all">All Client</option>
                        @foreach ($client_data as $c_item)
                            <option value="{{ $c_item->client_id }}" {{ \Request::get('clientData') == $c_item->client_id ? 'selected' : '' }}>{{ $c_item->client_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 form-group mb-0">
                    <label class="form-label">Status</label>
                    <select name="statusData" class="form-control">
                        <option value="all">All Status</option>
                        <option value="open" {{ \Request::get('statusData') == 'open' ? 'selected' : '' }}>OPEN</option>
                        <option value="doing" {{ \Request::get('statusData') == 'doing' ? 'selected' : '' }}>DOING</option>
                        <option value="done" {{ \Request::get('statusData') == 'done' ? 'selected' : '' }}>DONE</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <button id="filterResetButton" class="btn btn-secondary">Clear</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProjectModal">New</button>
            <button id="deleteButton" type="button" class="btn btn-danger">Delete</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input id="checkParent" type="checkbox">
                            </th>
                            <th>Action</th>
                            <th>Project Name</th>
                            <th>Client</th>
                            <th>Project Start</th>
                            <th>Project End</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $data as $item )
                            <tr>
                                <td class="text-center">
                                    <input id="checkChild" type="checkbox" name="project_id" value="{{ $item->project_id }}">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editProjectModal{{ $item->project_id }}">Edit</a>
                                </td>
                                <td>{{ $item->project_name }}</td>
                                <td>{{ $item->client->client_name }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->project_start)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->project_end)->format('d M Y') }}</td>
                                <td>{{ $item->project_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="createProjectModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('/project/store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="mb-0">Add New Project</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Project Name</label>
                            <div class="col-md-6">
                                <input type="text" name="project_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Client</label>
                            <div class="col-md-6">
                                <select name="client_id" class="form-control" required>
                                    <option value="" selected disabled>- Please select your client -</option>
                                    @foreach ($client_data as $c_item)
                                        <option value="{{ $c_item->client_id }}">{{ $c_item->client_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Project Start</label>
                            <div class="col-md-6">
                                <input type="date" name="project_start" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Project End</label>
                            <div class="col-md-6">
                                <input type="date" name="project_end" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Project Status</label>
                            <div class="col-md-6">
                                <select name="project_status" class="form-control" required>
                                    <option value="" selected disabled>- Please select status -</option>
                                    <option value="OPEN">OPEN</option>
                                    <option value="DOING">DOING</option>
                                    <option value="DONE">DONE</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach( $data as $item )
        <div id="editProjectModal{{ $item->project_id }}" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ url('/project/update') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="mb-0">{{ $item->project_name }} Update</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="project_id" value="{{ $item->project_id }}">

                            <div class="form-group row align-items-center">
                                <label class="form-label col-md-4 text-right mb-md-0">Project Name</label>
                                <div class="col-md-6">
                                    <input type="text" name="project_name" class="form-control" value="{{ $item->project_name }}" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="form-label col-md-4 text-right mb-md-0">Client</label>
                                <div class="col-md-6">
                                    <select name="client_id" class="form-control" required>
                                        <option value="" disabled>- Please select your client -</option>
                                        @foreach ($client_data as $c_item)
                                            <option value="{{ $c_item->client_id }}" {{ $item->client_id == $c_item->client_id ? 'selected' : '' }}>{{ $c_item->client_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="form-label col-md-4 text-right mb-md-0">Project Start</label>
                                <div class="col-md-6">
                                    <input type="date" name="project_start" class="form-control" value="{{ $item->project_start }}">
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="form-label col-md-4 text-right mb-md-0">Project End</label>
                                <div class="col-md-6">
                                    <input type="date" name="project_end" class="form-control" value="{{ $item->project_end }}">
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="form-label col-md-4 text-right mb-md-0">Project Status</label>
                                <div class="col-md-6">
                                    <select name="project_status" class="form-control" required>
                                        <option value="" disabled>- Please select status -</option>
                                        <option value="OPEN" {{ $item->project_status == 'OPEN' ? 'selected' : '' }}>OPEN</option>
                                        <option value="DOING" {{ $item->project_status == 'DOING' ? 'selected' : '' }}>DOING</option>
                                        <option value="DONE" {{ $item->project_status == 'DONE' ? 'selected' : '' }}>DONE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('script')
    <script>
        var collect = [];

        $('#filterResetButton').on('click', function() {
            $('input[name=searchData]').val('')
            $('select[name=clientData]').val('all')
            $('select[name=statusData]').val('all')
        })

        $(document).on('change', 'input#checkParent', function() {
            $(this).prop('checked', $(this).prop('checked'));
            $('input#checkChild').prop('checked', $(this).prop('checked'));

            if( $('input#checkChild').is(':checked') ) {
                $("table input[name=project_id]:checkbox:checked").map(function(){
                    collect.push( $(this).val() );
                });
            } else {
                $("table input[name=project_id]:checkbox").map(function(){
                    collect.splice( $.inArray( $(this).val(), collect), 1 );
                });
            }

            $('#deleteButton').click(function() {
                Swal.fire({
                    title: 'Apakah yakin menghapus data?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href="{{ url('/project/delete') }}/"+collect
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your data has been deleted.',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                    }
                })
            })
        })

        $(document).on('change', 'input#checkChild', function() {
            if( $(this).is(':checked') ) {
                collect.push( $(this).val() )
            } else {
                collect.splice( $.inArray( $(this).val(), collect), 1 );
            }

            $('#deleteButton').click(function() {
                Swal.fire({
                    title: 'Apakah yakin menghapus data?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href="{{ url('/project/delete') }}/"+collect
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your data has been deleted.',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                    }
                })
            })
        })

        $(document).ready(function() {
            $('#dataTable').DataTable({
                searching: false,
                pageLength: 5,
                lengthChange: false,
            });
        });
    </script>
@endpush