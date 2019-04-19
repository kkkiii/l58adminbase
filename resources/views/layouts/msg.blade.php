@foreach([ 'success','danger' ] as $t)
    @if(session()->has($t))


        <div class="alert alert-{{$t}}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{session()->get($t) }}</strong>
        </div>


    @endif

@endforeach