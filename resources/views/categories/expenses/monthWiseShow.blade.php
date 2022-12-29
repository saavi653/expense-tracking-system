@include('navbar')
@include('flash')
<a href="{{ route('user.dashboard') }}" class="btn btn-dark">GO BACK</a>
<table class="table table-success table-striped">
    @php
    $i=0
    @endphp
    <tr>
        <th> CATEGORY/ITEMS NAME </th>
        <th> COST</th>
    </tr>
    @if($expenses->first() == null)
        <div class="msg">NO RECORD FOUND</div>
    @else
        @foreach($expenses as $expense)
        <td><h5>{{ $categories[$i]['name'] }}</td>
        <td><h5>{{ number_format($expense->sum('cost')/$totalcost*100 , 2) }} %</td></h5>
        @foreach($expense as $exp)
        <tr>
            <td>{{ $exp->name }}</td>
            <td>{{ $exp->cost }}</td>
            @endforeach
        </tr>
        @php
            $i++;
        @endphp
        @endforeach
    @endif
</table>