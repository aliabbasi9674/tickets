@extends('layouts.admin')

@section('css')
    <link href="/home/assets/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="/home/assets/js/jquery.dataTables.min.js"></script>
    <script>
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

    </script>
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <span class="text-muted mt-1 tx-13 mr-2 mb-0"> سوابق تیکت ها</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <span type="button" class="text-info">{{verta()->format('%B %d، %Y')}}</span>
                </div>
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
                        <h4 class="card-title font-weight-bold text-primary mb-3">سوابق تیکت </h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">راه ارتباطی اصلی آپارتمانا با مشتریان سیستم تیکت می‌باشد. </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive userlist-table">
                        <table id="example" class="table card-table text-nowrap mb-0">
                            <thead style="background-color: #edeff2;">
                            <tr>
                                <th class="wd-lg-8p"><span>کاربر</span></th>
                                <th class="wd-lg-20p"><span></span></th>
                                <th class="wd-lg-8p"><span>شماره تیکت</span></th>
                                <th class="wd-lg-20p"><span>کد ساختمان</span></th>
                                <th class="wd-lg-20p"><span>موضوع</span></th>
                                <th class="wd-lg-20p"><span>تاریخ</span></th>
                                <th class="wd-lg-20p"><span>وضعیت</span></th>
                                <th class="wd-lg-20p">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $key => $ticket)
                                <tr>
                                    <td>
                                        <img class="rounded-circle avatar-md mr-2" alt="{{$ticket->user->Name}}" @if($ticket->user->Avatar)  src="{{env('APP_URL_API').$ticket->user->Avatar}}" @else  src="/home/assets/img/faces/icon-user.png" @endif>
                                    </td>
                                    <td>
                                        <span>{{$ticket->user->Name." ".$ticket->user->Family}}</span>
                                    </td>
                                    <td>
                                        <span class="text-primary">{{$ticket->Number}}</span>
                                    </td>
                                    <td>
                                        <span class="text-success">{{$ticket->TowerId}}</span>
                                    </td>
                                    <td>
                                        <span>{{$ticket->Subject}}</span>
                                    </td>
                                    <td>
                                        <span>{{verta($ticket->CreatedAt)->format('%B %d، %Y')}}</span>
                                    </td>
                                    <td class="text-center" style="line-height: inherit;">{{$ticket->Status}}</td>
                                    <td>
                                        <a href="{{route('admin.tickets.message',['ticket'=>$ticket->Id])}}" class="btn btn-sm btn-primary">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.tickets.destroy',['ticket' => $ticket->Id]) }}" onclick="confirmDelete({{$ticket->Id}})" class="btn btn-sm btn-danger">
                                            <i class="las la-trash"></i>
                                        </a>
                                        <form id="delete-form-{{$ticket->Id}}"
                                              action="{{ route('admin.tickets.destroy',['ticket' => $ticket->Id]) }}"
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
