@include('navbar')
@include('flash')
<div class="container">
    <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="head1"><b> ADD EXPENSES </b></h4>
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
            <input type="text" name="name" placeholder="enter name of item" value="{{ old('name') }}" required>
            <div class="error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="label">
            <input type="date" name="date" placeholder="date of expense" value="{{ old('date') }}" required>
            <div class="error">
                @error('date')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="label">
            <input type="text" name="cost" placeholder="enter cost of item" value="{{ old('cost') }}" required>
            <div class="error">
                @error('cost')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="label">
            <label>Add BILL</label>
            <input type="file" name="file" >
            <div class="error">
                @error('file')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="btn2">
            <input type="submit" name="submit" value="ADD" class="btn btn-dark">
            <input type="submit" name="submit" value="SAVE & ADD ANOTHER" class="btn btn-dark">
            <a href="{{ route('user.dashboard') }}" class="btn btn-dark">CANCEL</a>
        </div>
    </form>
</div>