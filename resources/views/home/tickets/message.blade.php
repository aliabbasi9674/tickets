@extends('layouts.home')


@section('js')
    <script>
        function changeStatus($ticketId) {
            event.preventDefault();
            swal({
                title: "تغییر وضعیت",
                text: "آیا تیکت بسته شود ؟",
                buttons: ["لغو", "تایید"],
                dangerMode: false,
            }).then((willDelete) => {
                if (willDelete) {
                    $.post("{{url(route('home.tickets.status'))}}", {
                        '_token': "{{csrf_token()}}",
                        'ticketId': $ticketId,
                    }, function (response, status) {
                        swal({
                            icon: 'success',
                            text: 'تغییر وضعیت با موفقیت انجام شد .',
                            button: 'باشه',
                        }).then((willDelete) => {
                            if (willDelete) {
                                $(location).attr('href', "{{route('home.tickets.index')}}");
                            }
                        })
                    }).fail(function (response) {
                        swal({
                            icon: 'error',
                            text: 'تغییر وضعیت با خطا مواجه است.',
                            button: 'باشه',
                        })
                    })
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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">تیکت {{$ticket->Number}} </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <div class="view-ticket-info mb-3">
                        <div class="row">
                            <div class="text-right col-md-6">
                                <h6 class="mb-2 text-primary">{{$ticket->Subject}}</h6>
                                <p class="mb-1"><b>تیکت {{$ticket->Number}}</b>
                                    <span class="px-2">|</span>
                                    <a href="#" class="service-link"></a></p>
                                <p class="mb-2">{{$ticket->category->Name}}</p>
                            </div>
                            <div class="col-md-6 text-left">
                                <p class="mb-2">
                                    <span class="bold">وضعیت تیکت</span>&nbsp;
                                    @switch($ticket->getRawOriginal('Status'))
                                        @case(0)
                                            <span class="tag tag-warning">در حال بررسی</span>
                                            @break
                                        @case(1)
                                            <span class="tag tag-success">پاسخ داده شده</span>
                                            @break
                                        @case(2)
                                            <span class="tag tag-gray">پاسخ مشتری</span>
                                            @break
                                        @case(3)
                                            <span class="tag tag-indigo">تکمیل شده</span>
                                            @break
                                        @case(4)
                                            <span class="tag tag-red">بسته شده</span>
                                            @break
                                    @endswitch
                                </p>
                                <p class="mb-2 reg_date"><span class="bold">زمان ایجاد</span> {{verta($ticket->CreatedAt)->format('%B %d، %Y')}} </p>
                                @if($ticket->getRawOriginal('Status')==4)
                                    <a href="{{route('home.tickets.index')}}">
                                        <button type="button" class="btn btn-sm btn-gray-700">بازگشت</button>
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-danger" onclick="changeStatus('{{$ticket->Id}}')">بستن تیکت
                                    </button>
                                @endif
                            </div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                    </div>
                    {{--                    <h4 class="card-title font-weight-bold text-primary mb-3">تیکت شماره {{$ticket->Number}}</h4>--}}
                    {{--                    <p class="mb-2">راه ارتباطی اصلی آپارتمانا با مشتریان سیستم تیکت می‌باشد.</p>--}}
                </div>
                <div class="card-body pt-0">
                    @if($ticket->getRawOriginal('Status')!=4)
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-horizontal" method="post" action="{{route('home.tickets.answer')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">پیام</label>
                                                <textarea type="text" required name="message" class="form-control" rows="4"
                                                          id="inputName"
                                                          placeholder="متن پیام خود را وارد کنید..."></textarea>
                                                @error('message')
                                                <p class="text-danger  mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="custom-file">
                                                <input class="custom-file-input" name="file1" type="file"> <label
                                                    class="custom-file-label" for="customFile">انتخاب فایل</label>
                                            </div>
                                            @error('file1')
                                            <p class="text-danger  mt-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="custom-file">
                                                <input class="custom-file-input" name="file2" type="file"> <label
                                                    class="custom-file-label" for="customFile">انتخاب فایل</label>
                                            </div>
                                            @error('file1')
                                            <p class="text-danger  mt-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="ticketId" value="{{$ticket->Id}}">
                                    </div>
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="submit" class="btn btn-primary">ارسال پاسخ</button>
                                            <a href="{{route('home.tickets.index')}}">
                                                <button type="button" class="btn btn-gray-700">بازگشت</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a class="main-header-arrow" href="#" id="ChatBodyHide"><i
                                    class="icon ion-md-arrow-back"></i></a>
                            <div class="main-content-body main-content-body-chat">
                                <div class="main-chat-body" id="ChatBody">
                                    <div class="">
                                        @foreach($messages as $message)
                                            @if($message->user->Role==1)
                                                <div class="media flex-row-reverse">
                                                    <div class="main-img-user online"><img alt=""
                                                                                           @if($message->user->Avatar)  src="{{env('APP_URL_API').$message->user->Avatar}}"
                                                                                           @else  src="/home/assets/img/faces/icon-user.png" @endif>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="main-msg-wrapper right">
                                                            <h6 class="text-left text-name-message">{{$message->user->Name}}  | <span>اپراتور</span></h6>
                                                            {!! $message->Content !!}
                                                            <div class="my-4">
                                                                @if($message->File1 || $message->File2)
                                                                    <hr>
                                                                    @if($message->File1)
                                                                        <div class="my-2">
                                                                            <a class="text-white" href="{{url(env('FILE_UPLOAD_PATH').$message->File1)}}"
                                                                               target="_blank">
                                                                                <i class="fa fa-file"></i>
                                                                                {{\Illuminate\Support\Str::limit($message->File1,25,'...')}}
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                    @if($message->File2)
                                                                        <div class="my-2">
                                                                            <a class="text-white" href="{{url(env('FILE_UPLOAD_PATH').$message->File2)}}"
                                                                               target="_blank">
                                                                                <i class="fa fa-file"></i>
                                                                                {{\Illuminate\Support\Str::limit($message->File2,25,'...')}}
                                                                            </a>
                                                                        </div>

                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <span>{{verta($message->CreatedAt)->format('%B %d، %Y - %H:%M')}}</span>
                                                            <a href=""><i
                                                                    class="icon ion-android-more-horizontal"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="media">
                                                    <div class="main-img-user online"><img alt=""
                                                                                           @if(auth()->user()->Avatar)  src="{{env('APP_URL_API').auth()->user()->Avatar}}"
                                                                                           @else  src="/home/assets/img/faces/icon-user.png" @endif>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="main-msg-wrapper left">
                                                            <h6 class="text-name-message">{{auth()->user()->Name}}  | <span>کاربر</span></h6>
                                                            {!! $message->Content !!}
                                                            <div class="my-4">
                                                                @if($message->File1 || $message->File2)
                                                                    <hr>
                                                                    @if($message->File1)
                                                                        <div class="my-2">
                                                                            <a href="{{url(env('FILE_UPLOAD_PATH').$message->File1)}}"
                                                                               target="_blank">
                                                                                <i class="fa fa-file"></i>
                                                                                {{\Illuminate\Support\Str::limit($message->File1,25,'...')}}
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                    @if($message->File2)
                                                                        <div class="my-2">
                                                                            <a href="{{url(env('FILE_UPLOAD_PATH').$message->File2)}}"
                                                                               target="_blank">
                                                                                <i class="fa fa-file"></i>
                                                                                {{\Illuminate\Support\Str::limit($message->File2,25,'...')}}
                                                                            </a>
                                                                        </div>

                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <span>{{verta($message->CreatedAt)->format('%B %d، %Y - %H:%M')}}</span>
                                                            <a href=""><i
                                                                    class="icon ion-android-more-horizontal"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="mt-5">
                                            {{ $messages->links("pagination::bootstrap-4") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
