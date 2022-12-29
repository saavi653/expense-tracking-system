@include('navbar')
@include('flash')
<div class="container">
    <form action="{{ route('expenses.update', $expense) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="head1"><b> EDIT EXPENSE </b> </h4>
        <div class="label"><label>Choose Category</label>
            <select class="input" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="error">
                @error('category_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="label">
            <input type="text" name="name" value="{{ $expense->name }}" required>
            <div class="error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="label">
            <input type="date" name="date" value="{{ $expense->date }}" required>
            <div class="error">
                @error('date')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="label">
            <input type="text" name="cost" value="{{ $expense->cost }}" required>
            <div class="error">
                @error('cost')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="btn2">
            <input type="submit" name="submit" value="UPDATE" class="btn btn-dark">
            <a href="{{ route('expenses.show') }}" class="btn btn-dark">CANCEL</a>
        </div>
    </form>
</div>