<img width="100" alt="{{auth()->user()->Name}}" @if(auth()->user()->Avatar)  src="{{env('APP_URL_API').auth()->user()->Avatar}}" @else  src="/home/assets/img/faces/icon-user.png" @endif>
