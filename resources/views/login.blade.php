@extends('layout.layout')
@section('content')

    <div class="login-form bg-basic p-3 text-center rounded-4 w-50 m-auto mt-2">
        <form method="post" action="{{ url('login') }}">
            @csrf
            <h3>Login</h3>

            <div class="form-floating mb-3 mt-4">
                <input type="email" name="email" class="form-control" id="email" placeholder="email">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3 mt-2">
                <input type="password" name="password" class="form-control" id="password" placeholder="password">
                <label for="password">password</label>
            </div>
            <div class="login-btn">
                <button type="submit" class="btn btn-dark">Submit</button>
            </div>
        </form>

        @if (!$errors->first())
            <div class="d-none">
                {{ $show = 'd-none' }}
            </div>
        @else
            <div class="d-none">
                {{ $show = 'd-block' }}
            </div>
        @endif
        <div class="alert alert-danger @php echo $show @endphp">
            {{ $errors->first() }}
        </div>

    </div>
@stop
