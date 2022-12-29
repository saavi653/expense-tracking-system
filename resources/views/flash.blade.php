<div class="flash">
@if($msg=Session::get('success') )
    <h4>{{ $msg }}</h4>
    @elseif($msg=Session::get('error'))
        <h4>{{ $msg }}</h4>
@endif
</div>