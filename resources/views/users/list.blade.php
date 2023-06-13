<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">    <title>Document</title>
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">full name</th>
      <th scope="col">mail</th>
      <th scope="col">level</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $users)
    <tr>
      <th scope="row">{{$users->users_id}}</th>
      <td>
        <a href="{{route('users.detail',['id'=> $users->users_id])}}"> {{ $users->user_full}}</td>
      <td>{{ $users->user_mail}}</td>
      <td>
            @if($users ->user_level == 1)
            <p>admin</p>
            @else
            <p>Member</p>
            @endif

      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>