@extends('layouts.admin.app')
@section('title', 'User')
@section('user', 'active')
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
                                <a href="{{ route('admin.user.create') }}" class="btn btn-primary float-right">
                                    <i class="fa fa-plus"></i> Add User
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="Admin" class="table table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>

                                        <th>Status</th>
                                        <th class="hidden" style="width:10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) > 0)
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ ++$id }}</td>
                                                <td>
                                                    <img src="{{ $user->avatarImg($user->avatar) }}"
                                                        class="imageSize" alt="">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <?php echo $user->status ? '<span class="cur_sor badge badge-success" onclick="updateStatus(' . $user->id . ',$(this))">Active</span>' : '<span class="badge badge-warning cur_sor" onclick="updateStatus(' . $user->id . ',$(this))">Inactive</span>'; ?>
                                                </td>
                                                <td>
                                                    <div class="d-inline-flex">
                                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                                            class="btn btn-primary btn-sm" title="Edit User">
                                                            <i class="fa fa-edit iCheck"></i>
                                                        </a>
                                                    </div>
                                                </td>
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
            $("#Admin").DataTable({
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

        function updateStatus(id, el) {
            console.log(el);
            if (id) {
                $.ajax({
                    url: "{{ route('admin.user.updateStatus') }}",
                    type: 'POST',
                    data: {
                        'user_id': id
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            el.text('Inactive');
                            el.removeClass('badge-success').addClass('badge-warning');
                        } else if (data.status == 1) {
                            el.text('Active');
                            el.removeClass('badge-warning').addClass('badge-success');
                        }
                        toastr.success(data.msg);
                    }
                });
            }
        }
    </script>
@endsection
