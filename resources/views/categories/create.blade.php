@include('navbar')
@include('flash')
<div class="container">
    <form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="label">
        <h4 class="head2"><b>ADD CATEGORY</b></h4>
        <label>Category Name </label>
        <input type="text" name="name" required>
        <div class="error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="btn3">
        <input type="submit" name="submit" value="ADD" class="btn btn-dark">
        <a href="{{ route('user.dashboard') }}" class="btn btn-dark">CANCEL</a>
    </div>
    </form>
</div>