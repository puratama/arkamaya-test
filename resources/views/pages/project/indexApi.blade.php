@extends('layouts.app')

@push('title')
    Project
@endpush

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Project</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form id="handleSubmit" class="row align-items-end">
                <div class="col-md-1">
                    <h2 style="font-size: 20px; font-weight: 700;">Filter</h2>
                </div>
                <div class="col-md-5 form-group mb-0">
                    <label class="form-label">Project Name</label>
                    <input type="text" name="projectData" class="form-control">
                </div>
                <div class="col-md-2 form-group mb-0">
                    <label class="form-label">Client</label>
                    <select name="clientData" class="form-control">
                        <option value="all">All Client</option>
                    </select>
                </div>
                <div class="col-md-2 form-group mb-0">
                    <label class="form-label">Status</label>
                    <select name="statusData" class="form-control">
                        <option value="all">All Status</option>
                        <option value="open">OPEN</option>
                        <option value="doing">DOING</option>
                        <option value="done">DONE</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <button id="clearButton" class="btn btn-secondary">Clear</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProjectModal">New</button>
            <button id="deleteButton" class="btn btn-danger">Delete</button>
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
                    <tbody></tbody>
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

    <div id="editProjectModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('/project/update') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="mb-0"></h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" value="">

                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Project Name</label>
                            <div class="col-md-6">
                                <input type="text" name="project_name" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Client</label>
                            <div class="col-md-6">
                                <select name="client_id" class="form-control" required>
                                    <option value="" disabled>- Please select your client -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Project Start</label>
                            <div class="col-md-6">
                                <input type="date" name="project_start" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Project End</label>
                            <div class="col-md-6">
                                <input type="date" name="project_end" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-label col-md-4 text-right mb-md-0">Project Status</label>
                            <div class="col-md-6">
                                <select name="project_status" class="form-control" required>
                                    <option value="" disabled>- Please select status -</option>
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
@endsection

@push('script')
    <script>
        var collect = [];
        var month = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $(document).on('click', 'a[data-toggle=modal]', function() {
            var thisAttr = $(this).attr('data-project-id')
            var modal = $('#editProjectModal')
            var modalHeader = modal.find('.modal-header h5')
            var projectId = modal.find('input[name=project_id]')
            var projectName = modal.find('input[name=project_name]')
            var clientId = modal.find('select[name=client_id]')
            var projectStart = modal.find('input[name=project_start]')
            var projectEnd = modal.find('input[name=project_end]')
            var projectStatus = modal.find('select[name=project_status]')
            
            modalHeader.text('')
            projectId.val('')
            projectName.val('')
            clientId.val('')
            projectStart.val('')
            projectEnd.val('')
            projectStatus.val('')
            
            $.ajax({
                type: 'GET',
                url: '{{ url("/api/projects?project_id=") }}'+thisAttr,
                success: function(res) {
                    modalHeader.text(res[0].project_name+' Update')
                    projectId.val(res[0].project_id)
                    projectName.val(res[0].project_name)
                    clientId.val(res[0].client_id)
                    projectStart.val(res[0].project_start)
                    projectEnd.val(res[0].project_end)
                    projectStatus.val(res[0].project_status)
                }
            })
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

        $('#clearButton').on('click', function() {
            $('#handleSubmit').find('input[name=projectData]').val('')
            $('#handleSubmit').find('select[name=clientData]').val('all')
            $('#handleSubmit').find('select[name=statusData]').val('all')
        })

        $('#handleSubmit').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                project_name: $('input[name=projectData]').val() == '' ? null : $('input[name=projectData]').val(),
                client_id: $('select[name=clientData]').val(),
                project_status: $('select[name=statusData]').val(),
            }

            $('tbody').html(`
                <tr>
                    <td colspan="7" class="text-center">Mohon tunggu ...</td>
                </tr>
            `)

            $.ajax({
                type: 'GET',
                url: '{{ url("/api/projects") }}',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    $('tbody').html('')

                    if( res.length > 0 ) {
                        for(i=0; i<res.length; i++) {
                            $('tbody').append(`
                                <tr>
                                    <td class="text-center">
                                        <input id="checkChild" type="checkbox" name="project_id" value="`+ res[i].project_id +`">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#editProjectModal" data-project-id="`+ res[i].project_id +`">Edit</a>
                                    </td>
                                    <td>`+ res[i].project_name +`</td>
                                    <td>`+ res[i].client.client_name +`</td>
                                    <td>`+ res[i].project_start +`</td>
                                    <td>`+ res[i].project_end +`</td>
                                    <td>`+ res[i].project_status +`</td>
                                </tr>
                            `)
                        }
                    } else {
                        $('tbody').html(`
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        `)
                    }
                }
            })
        })

        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ url("/api/projects") }}',
                success: function(res) {
                    $('tbody').html('')

                    for(i=0; i<res.length; i++) {
                        var startDate = new Date(res[i].project_start);
                        var endDate = new Date(res[i].project_end);

                        $('tbody').append(`
                            <tr>
                                <td class="text-center">
                                    <input id="checkChild" type="checkbox" name="project_id" value="`+ res[i].project_id +`">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editProjectModal" data-project-id="`+ res[i].project_id +`">Edit</a>
                                </td>
                                <td>`+ res[i].project_name +`</td>
                                <td>`+ res[i].client.client_name +`</td>
                                <td>`+ startDate.getDate().toString() + ' ' + month[startDate.getMonth()].toString()+ ' ' + startDate.getFullYear().toString() +`</td>
                                <td>`+ endDate.getDate().toString() + ' ' + month[endDate.getMonth()].toString()+ ' ' + endDate.getFullYear().toString() +`</td>
                                <td>`+ res[i].project_status +`</td>
                            </tr>
                        `)
                    }
                }
            })

            $('#dataTable').DataTable({
                searching: false,
                ordering: false,
                lengthChange: false,
                bInfo: false,
            });

            $.ajax({
                type: 'GET',
                url: '{{ url("/api/clients") }}',
                success: function(res) {
                    for(i=0; i<res.length; i++) {
                        $('select[name=clientData]').append(`
                            <option value="`+ res[i].client_id +`">`+ res[i].client_name +`</option>
                        `)
                    }
                }
            })

            $.ajax({
                type: 'GET',
                url: '{{ url("/api/clients") }}',
                success: function(res) {
                    for(i=0; i<res.length; i++) {
                        $('select[name=client_id]').append(`
                            <option value="`+ res[i].client_id +`">`+ res[i].client_name +`</option>
                        `)
                    }
                }
            })
        });
    </script>
@endpush