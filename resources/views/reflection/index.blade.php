<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
<h1>Adding Criteria!</h1>
<br>



<form action="{{ route('/posts') }}" method="post">
    @csrf

    <label for="">Name :</label>
    <input type="text" name="name" id="">
    <br>
    <label for="">Description : </label>
    <input type="text" name="description" id="">
    <br>
    <button type="submit">Save</button>

</form>


</body>
</html>
