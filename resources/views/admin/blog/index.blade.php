@extends('layouts.admin.app')
@section('title', 'Blog')
@section('blog', 'active')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">
                                <a>
                                    <span class="content-header">All blogs</span>
                                </a>
                                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary float-right">
                                    <i class="fa fa-plus"></i> Add Blog
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="Blog" class="table table-responsive-xl">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Tags</th>
                                            <th>Status</th>
                                            <th class="hidden">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $key => $blog)
                                            <tr>
                                                <td>{{ ++$id }}</td>
                                                <td>
                                                    <img src="{{ $blog->getImg($blog->image) }}" class="imageSize"
                                                        alt="">
                                                </td>
                                                <td>{{ $blog->name }}</td>
                                                <td>
                                                    <textarea>
                                                {{ strip_tags(html_entity_decode($blog->description)) }}
                                                </textarea>
                                                </td>

                                                <td>{{ $blog->categories()->exists() ? $blog->categories()->first()->name : '' }}
                                                </td>
                                                <td>{{ $blog->tags()->exists() ? $blog->tags()->first()->name : '' }}
                                                </td>
                                                <td>
                                                    <?php echo $blog->status ? '<span class="cur_sor badge badge-success" onclick="updateStatus(' . $blog->id . ',$(this))">Active</span>' : '<span class="badge badge-warning cur_sor" onclick="updateStatus(' . $blog->id . ',$(this))">Inactive</span>'; ?>
                                                </td>
                                                <td>
                                                    <div class="d-inline-flex">
                                                        <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                                            class="btn btn-sm btn-primary" title="Edit Blog">
                                                            <i class="fa fa-edit iCheck"></i>
                                                        </a>
                                                        <form action="{{ route('admin.blog.delete', $blog->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger ml-2" type="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

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
            $("#Blog").DataTable({
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
                    url: "{{ route('admin.blog.updateStatus') }}",
                    type: 'POST',
                    data: {

                        'blog_id': id
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
