<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    @include('sweetalert::alert')
    @if (isset($error))
        {{-- <div class="row">
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        </div> --}}
    @endif
    <div class="row">
        <form method="post" action="/logout">
            @csrf
            <button class="w-15 btn btn-lg btn-danger" type="submit">Sign Out</button>
        </form>
    </div>
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Todolist</h1>
            <p class="col-lg-10 fs-4">by <a target="_blank" href="https://zaee07.my.id/">zaee 07</a></p>
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
                    <th scope="col">#</th>
                    <th scope="col">Todo</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($todolist as $todo)
                        <tr>
                            <th>{{ $todo['id'] }}</th>
                            <td scope="row">{{ $todo['todo'] }}</td>
                            <td>
                                <form action="/todolist/{{ $todo['id'] }}/delete" method="post">
                                    @csrf
                                    <button class="btn btn-outline-danger" type="submit" data-confirm-delete="true"><i class="fa-sm fa-solid fa-trash"></i></button>
                                </form>
                                {{-- <a href="/todolist/{{ $todo["id"] }}/delete" class="w-100 btn btn-danger btn-m">remove</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/dce29a683d.js" crossorigin="anonymous"></script>
</body>
</html>