@include('navbar')
@include('flash')
<a href="{{ route('categories.create') }}" class="btn btn-dark">ADD CATEGORY</a>
<a href="{{ route('expenses.create') }}" class="btn btn-dark">ADD EXPENSE</a>
<a href="{{ route('expenses.show') }}" class="btn btn-dark">SHOW EXPENSES</a>
<table class="table table-hover">
    <tr>
       <th> MONTHS </th>
       <th> EXPENSES </th>
       <th> COMPARISON </th>
    </tr> 
    <tr>
    @php 
        $i=0;
    @endphp
    @foreach($expenses as $expense)
        <td>
           <a href="{{ route('categories.expenses.show') }}?name={{ $expense->name }}">{{ $expense->name }}</a>
        </td>   
        @if($expense->expenses==null)
            <td>NULL</td>
        @else   
            <td>{{ $expense->expenses}}</td>  
        @endif
        @if($comparison[$i] <= 0)
            <td>{{ number_format(abs($comparison[$i]), 2) }} %</td>
        @else
            <td class="error">{{ number_format($comparison[$i], 2) }} %</td>
        @endif
        @php 
            $i++;
        @endphp
    </tr>   
    @endforeach    
</table>

