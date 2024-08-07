<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    @foreach ($users as $company => $departments)
        <h2>{{ $company }}</h2>
        @foreach ($departments as $department => $users)
            <h3>{{ $department }}</h3>
            <ul>
                @foreach ($users as $user)
                    <li>{{ $user->name }} ({{ $user->email }})</li>
                @endforeach
            </ul>
        @endforeach
    @endforeach
</body>
</html>
