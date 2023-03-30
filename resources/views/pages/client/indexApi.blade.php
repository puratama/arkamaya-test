@extends('layouts.app')

@push('title')
    Client
@endpush

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Client</h1>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input id="checkParent" type="checkbox">
                            </th>
                            <th>Name</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ url("/api/clients") }}',
                success: function(res) {
                    $('tbody').html('')

                    for(i=0; i<res.length; i++) {
                        $('tbody').append(`
                            <tr>
                                <td class="text-center">
                                    <input id="checkChild" type="checkbox" name="project_id" value="`+ res[i].project_id +`">
                                </td>
                                <td>`+ res[i].client_name +`</td>
                                <td>`+ res[i].client_address +`</td>
                            </tr>
                        `)
                    }
                }
            })

            $('#dataTable').DataTable({
                searching: false,
                ordering: false,
            });

            $(document).on('change', 'input#checkParent', function() {
                $(this).prop('checked', $(this).prop('checked'));
                $('input#checkChild').prop('checked', $(this).prop('checked'));
            })
        })
    </script>
@endpush