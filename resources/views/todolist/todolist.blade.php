<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        @if (Session::has('status'))
            @if (Session::get('status') == 'success')
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
        @endif
        <div class="row">
            <form method="post" action="/logout">
                @csrf
                <button class="w-15 btn btn-lg btn-danger" type="submit">Sign Out</button>
            </form>
        </div>
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Welcome</h1>
                <p class="col-lg-10 fs-4">{{ Str::title(Auth::user()->name) }}</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/todolist">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="todo" placeholder="todo">
                        <label for="todo">Todo</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Add Todo</button>
                </form>
            </div>
        </div>
        <div class="row align-items-right g-lg-5 py-5">
            <div class="mx-auto">
                <form id="deleteForm" method="post" style="display: none">

                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Do</th>
                            <th scope="col">#</th>
                            <th scope="col">Todo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todolists->todolist as $todo)
                            <tr>
                                <td>
                                    <form action="/todolist/check/{{ $todo->todo_id }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <input type="checkbox" id="flexCheckDefault" onChange="this.form.submit()"
                                            name="todo_id" {{ $todo->checked ? 'checked' : '' }}>
                                    </form>
                                </td>
                                <th scope="row">{{ $todo->todo_id }}</th>
                                <td>{{ $todo->todo }}</td>
                                <td>
                                    <form action="/todolist/{{ $todo->todo_id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="w-100 btn btn-md btn-danger" type="submit">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
