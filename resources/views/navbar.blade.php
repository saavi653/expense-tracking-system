@include('layout.main')
<div class="nav">
  <h5><b>{{ Auth::user()->full_name }}</h5>
  <h5>EXPENSE TRACKER SYSTEM</b></h5>
<a href="{{ route('logout') }}" class="btn btn-dark btn1">LOGOUT</a>
</div>