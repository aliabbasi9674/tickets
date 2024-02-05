@extends('layouts.admin')


@section('js')
    <script>
        function changeStatus($ticketId) {
            event.preventDefault();
            swal({
                title: "تغییر وضعیت",
                text: "آیا وضعیت تیکت ویرایش شود ؟",
                buttons: ["لغو", "تایید"],
                dangerMode: false,
            }).then((willDelete) => {
                if (willDelete) {
                    $.post("{{url(route('admin.tickets.status'))}}", {
                        '_token': "{{csrf_token()}}",
                        'ticketId': $ticketId,
                        'status':$('#status').val()
                    }, function (response, status) {
                        $(' #div-status').load(' #text-status')
                        swal({
                            icon: 'success',
                            text: 'تغییر وضعیت با موفقیت انجام شد .',
                            button: 'حله',
                            timer: 4000
                        })
                    }).fail(function (response) {
                        swal({
                            icon: 'error',
                            text: 'تغییر وضعیت با خطا مواجه است.',
                            button: 'باشه',
                            timer: 4000
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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">مشخصات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title font-weight-bold text-primary mb-3">تیکت شماره {{$ticket->Number}}</h4>
                    <p class="mb-2">راه ارتباطی اصلی آپارتمانا با مشتریان سیستم تیکت می‌باشد.</p>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="pl-0">
                                    <div class="main-profile-overview text-center">
                                        <div class="main-img-user profile-user my-4">
                                            <img alt="{{$ticket->user->Name}}" @if($ticket->user->Avatar)  src="{{env('APP_URL_API').$ticket->user->Avatar}}" @else  src="/home/assets/img/faces/icon-user.png" @endif>
                                        </div>
                                        <div class="text-center">
                                            <h5 class="main-profile-name">{{$ticket->user->Name}}</h5>
                                            <p class="main-profile-name-text text-success">کد ساختمان
                                                : {{$ticket->TowerId}}</p>
                                        </div>

                                        <div id="div-status">
                                            <h6 id="text-status" class="text-center">وضعیت تیکت :
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
                                            </h6>
                                        </div>

                                        <h6 class="my-5"><i
                                                class="icon icon-calendar"></i> {{verta($ticket->CreatedAt)->format('%B %d، %Y')}}
                                        </h6>
                                    </div><!-- main-profile-overview -->
                                </div>
                            </div>
                            <div>
                                <label>وضعیت :</label>
                                <select class="form-control" id="status" onchange="changeStatus('{{$ticket->Id}}')"
                                        name="status">
                                    <option
                                        value="0" {{$ticket->getRawOriginal('Status')==0 ? 'selected': ''}}>
                                        ارسال شده
                                    </option>
                                    <option
                                        value="1" {{$ticket->getRawOriginal('Status')==1 ? 'selected': ''}}>
                                        پاسخ داده
                                    </option>
                                    <option
                                        value="2" {{$ticket->getRawOriginal('Status')==2 ? 'selected': ''}}>
                                        در حال بررسی
                                    </option>
                                    <option
                                        value="3" {{$ticket->getRawOriginal('Status')==3 ? 'selected': ''}}>
                                        تکمیل شده
                                    </option>
                                    <option
                                        value="4" {{$ticket->getRawOriginal('Status')==4 ? 'selected': ''}}>
                                        رد شده
                                    </option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <a class="main-header-arrow" href="#" id="ChatBodyHide"><i
                                        class="icon ion-md-arrow-back"></i></a>
                                <div class="main-content-body main-content-body-chat">
                                    <div class="main-chat-header">
                                        <div class="main-chat-msg-name">
                                            <h6>موضوع {{$ticket->Subject}}</h6>
                                            <small>{{$ticket->category->Name}}</small>
                                        </div>
                                        <nav class="nav">
                                            <span
                                                class="text text-warning">{{verta($ticket->CreatedAt)->format('%B %d، %Y')}} </span>
                                        </nav>
                                    </div><!-- main-chat-header -->
                                    <div class="main-chat-body" id="ChatBody">
                                        <div class="content-inner">
                                            @foreach($ticket->messages as $message)
                                                @if($message->user->Role==2)
                                                    <div class="media flex-row-reverse">
                                                        <div class="main-img-user online"><img alt="{{$message->user->Name}}"
                                                                                               @if($message->user->Avatar)  src="{{env('APP_URL_API').$message->user->Avatar}}" @else  src="/home/assets/img/faces/icon-user.png" @endif>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="main-msg-wrapper right">
                                                                <h6 class="text-left text-name-message">{{$message->user->Name}}  | <span>کاربر</span></h6>
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
                                                        <div class="main-img-user online"><img alt="{{auth()->user()->Name}}"
                                                                                               @if(auth()->user()->Avatar)  src="{{env('APP_URL_API').auth()->user()->Avatar}}" @else  src="/home/assets/img/faces/icon-user.png" @endif>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="main-msg-wrapper left">
                                                                <h6 class="text-name-message">{{auth()->user()->Name}}  | <span>ادمین</span></h6>
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
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-3">پاسخ به تیکت </h4>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" method="post" action="{{route('admin.tickets.answer')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">پیام</label>
                                    <textarea type="text" name="message" required class="form-control" rows="7" id="inputName"
                                              placeholder="متن پیام خود را وارد کنید..."></textarea>
                                    @error('message')
                                    <p class="text-danger  mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="file1" type="file"> <label
                                        class="custom-file-label" for="customFile">انتخاب فایل</label>
                                </div>
                                @error('file1')
                                <p class="text-danger  mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
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
                                <button type="submit" class="btn btn-primary">ارسال تیکت</button>
                                <a href="{{route('admin.tickets.index')}}">
                                    <button type="button" class="btn btn-gray-700">بازگشت</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
