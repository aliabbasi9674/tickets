@extends('layouts.admin')
@section('css')
    <link href="/home/assets/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="/home/assets/js/jquery.dataTables.min.js"></script>
    <script>
        function confirmDelete(id) {
            event.preventDefault();
            swal({
                title: "حذف",
                text: "آیا آیتم مورد نظر حذف شود؟",
                buttons: ["لغو", "حذف"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // اگر تایید حذف شد، انجام عمل حذف
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        $('#example').DataTable({
            "processing": true,
            "order": [],
            "searching": true,
            "pageLength": 10,
            language: {
                "lengthMenu": "نمایش _MENU_ داده در هر صفحه",
                "zeroRecords": "هیچ اطلاعاتی با این مشخصات یافت نشد!!!",
                "info": "صفحه _PAGE_ از _PAGES_",
                "infoEmpty": "داده‌ای موجود نیست!",
                "search": "جستجو: ",
                "paginate": {
                    "first": "اول",
                    "last": "آخر",
                    "next": "بعدی",
                    "previous": "قبلی"
                },
                "infoFiltered": "(نتیجه جستجو در بین اطلاعات _MAX_ اطلاعاتی)"
            }
        });
    </script>
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <span class="text-muted mt-1 tx-13 mr-2 mb-0"> سرویس تیکت ها</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="mb-3 mb-xl-0">
                <span type="button" class="mx-2 text-info">{{verta()->format('%B %d، %Y')}}</span>
                <a href="{{route('admin.categories.create')}}" class="ml-2">
                    <button class="btn btn-primary">ثبت سرویس جدید</button>
                </a>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title font-weight-bold text-primary mb-3">سرویس تیکت شما</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">راه ارتباطی اصلی آپارتمانا با مشتریان سیستم تیکت می‌باشد. </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive userlist-table">
                        <table id="example" class="table card-table text-nowrap mb-0">
                            <thead style="background-color: #edeff2;">
                            <tr>
                                <th class="wd-lg-8p"><span>#</span></th>
                                <th class="wd-lg-20p"><span>نام</span></th>
                                <th class="wd-lg-20p"><span>وضعیت</span></th>
                                <th class="wd-lg-20p">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <td><span>{{$key+1}}</span></td>
                                    <td>
                                        <span>{{$category->Name}}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($category->getRawOriginal('Status'))
                                            <span class="label text-success d-flex"><div
                                                    class="dot-label    bg-success ml-1"></div>غیر فعال</span>
                                        @else
                                            <span class="label text-muted d-flex"><div
                                                    class="dot-label bg-gray-300 ml-1"></div>غیر فعال</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit',['category' => $category->Id]) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="las la-pen"></i>
                                        </a>
                                        <a onclick="confirmDelete({{$category->Id}})"
                                           href="{{ route('admin.categories.destroy',['category' => $category->Id]) }}"
                                           class="btn btn-sm btn-danger">
                                            <i class="las la-trash"></i>
                                        </a>
                                        <form id="delete-form-{{$category->Id}}"
                                              action="{{ route('admin.categories.destroy',['category' => $category->Id]) }}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- row closed  -->
@endsection
