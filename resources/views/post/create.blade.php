<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Create Post</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="">
        <label for="text">Post Title </label>
        <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror">
        @error('title')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </form>
    {{-- @extends('namespace::layout')

    <div class="container">
        <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>  
        </div>
    </div> --}}
</body>

</html>