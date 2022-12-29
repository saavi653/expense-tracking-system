@include('navbar')
@include('flash')
<div class="bar">
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      FILTER 
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{ route('expenses.show') }}">ALL</a></li>
      <li><a class="dropdown-item" href="{{ route('expenses.show') }}?sort=thisweek">THIS WEEK</a></li>
      <li><a class="dropdown-item" href="{{ route('expenses.show') }}?sort=lastweek">LAST WEEK</a></li>
      <li><a class="dropdown-item" href="{{ route('expenses.show') }}?sort=thismonth">THIS MONTH</a></li>
      <li><a class="dropdown-item" href="{{ route('expenses.show') }}?sort=lastmonth">LAST MONTH</a></li>
      <li><form action="{{ route('expenses.show') }}"method="get">
        @csrf
        <label>FROM</label>
        <input type="date" name="from">
        <label>TO</label>
        <input type="date" name="to">
        <input type="submit" value="APPLY">
      </li>
    </ul>
  </div>
  <form action="" method="get">
      <div class="search">
          <input  type="text" name="search" placeholder="Search by Name" value="{{ request()->search }}">
      </div>
  </form>
  <a href="{{ route('user.dashboard') }}" class="btn btn-dark">GO BACK</a>
</div>

<table class="table table-hover">
    <tr>
        <th>DATE</th>
        <th>EXPENSE</th>
        <th>COST</th>
        <th>BILL</th>
        <th>EDIT</th>
        <th></th>
    </tr>
@if($expenses->first()== null)
<div class="msg">NO RECORD FOUND</div>
@else
<tr>
  @foreach($expenses as $expense)
    <td>{{ $expense->date }}</td>
    <td>{{ $expense->name }}</td>
    <td>{{ $expense->cost }}</td>
    <td><a href="{{ asset('storage/'.$expense->url) }}" target="_blank">Bill</a></td>
    <td><a href="{{ route('expenses.edit', $expense) }}">EDIT</a>
    <td>{{ \Carbon\Carbon::parse($expense->date)->diffForHumans() }}</td>
    </tr>
  @endforeach
  {{ $expenses->links() }}
@endif 
</table> 

 


