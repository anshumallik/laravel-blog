@extends('layouts.admin.app')
@section('title', 'Tag')
@section('tag', 'active')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">
                                <a>
                                    <span class="content-header">All Tags</span>
                                </a>
                                <a href="{{ route('admin.tag.create') }}" class="btn btn-primary float-right">
                                    <i class="fa fa-plus"></i> Add Tag
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="Tag" class="table table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th class="hidden">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="sortedtable">
                                    @foreach ($tags as $key => $tag)
                                        <tr data-id="{{ $tag->id }}" class="sortRow">
                                            <td style='cursor: pointer;'>{{ ++$id }}</td>
                                            <td style='cursor: pointer;'>{{ $tag->name }}</td>
                                            <td>
                                                <?php echo $tag->status ? '<span class="cur_sor badge badge-success" onclick="updateStatus(' . $tag->id . ',$(this))">Active</span>' : '<span class="badge badge-warning cur_sor" onclick="updateStatus(' . $tag->id . ',$(this))">Inactive</span>'; ?>
                                            </td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="{{ route('admin.tag.edit', $tag->id) }}"
                                                        class="btn btn-sm btn-primary" title="Edit Client tag">
                                                        <i class="fa fa-edit iCheck"></i>
                                                    </a>
                                                    <form action="{{ route('admin.tag.delete', $tag->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger ml-2"
                                                            type="submit"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $("#Tag").DataTable({
                "responsive": false,
                "lengthChange": true,
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

        });




        function updateStatus(id, el) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (id) {
                $.ajax({
                    url: "{{ route('admin.tag.updateStatus') }}",
                    type: 'POST',
                    data: {

                        'tag_id': id
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
