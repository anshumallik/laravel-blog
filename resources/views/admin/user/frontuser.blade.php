@extends('layouts.admin.app')
@section('title', 'User')
@section('user-front', 'active')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a>
                                    <span class="content-header">All Users</span>
                                </a>

                            </div>
                        </div>
                        <div class="card-body">
                            <table id="FrontEndUSer" class="table table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th>S.N</th>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($frontusers) > 0)
                                        @foreach ($frontusers as $key => $user)
                                            <tr>
                                                <td>{{ ++$id }}</td>

                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone ? $user->phone : '' }}</td>
                                                <td>{{ $user->address }}</td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#FrontEndUSer").DataTable({
                "responsive": false,
                "autoWidth": false,
                "dom": 'lBfrtip',
                "buttons": [{
                        extend: 'collection',
                        text: "<i class='fa fa-ellipsis-v'></i>",
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'csv',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'excel',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'pdf',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'print',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                },

                            },
                        ],

                    },
                    {
                        extend: 'colvis',
                        columns: ':not(.hidden)'
                    }
                ],

                "language": {
                    "infoEmpty": "No entries to show",
                    "emptyTable": "No data available",
                    "zeroRecords": "No records to display",
                }
            });
            dataTablePosition();
        });
    </script>
@endsection
