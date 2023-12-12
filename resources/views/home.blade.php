<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    {{-- Muestro esto si el usuario esta registrado --}}
    @auth
    <p>Congrats you are inside</p>
    <form action="{{ route('user.logout') }}" method="POST">
        @csrf
        <button>Log out</button>
    </form>

    {{-- Para los posts --}}
    <div style="border: 3px solid black">
        <h2>Create a new post</h2>
        <form action="{{route('post.create')}}" method="POST">
            @csrf
            <input type="text" name="tittle" placeholder="title">
            <textarea name="body" placeholder="body content..."></textarea>
            <button> Save post</button>
        </form>
    </div>

    <div style="border: 3px solid black">
        <h2>All posts</h2>
        @foreach ( $posts as $post )
            <div style="background-color: gray; padding: 10px; margin: 10px">
                {{-- Con un modal seria de la siguiente manera --}}
                {{-- <h3>{{$post['tittle']}} by {{$post->user->name}}</h3> --}}

                {{-- Con el auth --}}
                <h3>{{$post['tittle']}} by {{auth()->user()->name}}</h3>
                    {{$post['body']}}
                <p><a href="{{route('post.edit', ['post'=> $post])}}">Edit</a></p>

                <form action="{{route('post.delete', ['post'=> $post])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </div>
            
        @endforeach
    </div>


    {{-- Si no esta registrado se muestra el else --}}
    @else
    <div style="border: 3px solid black">
        <h2>Register</h2>
        <form action="{{route('user.register')}}" method="POST">
            @csrf
            <input type="text" placeholder="name" name="name">
            @error('name')
                <p>{{$message}}</p>
            @enderror
            <input type="text" placeholder="email" name="email">
            @error('email')
                <p>{{$message}}</p>
            @enderror
            <input type="password" placeholder="password" name="password">
            @error('password')
                <p>{{$message}}</p>
            @enderror
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black">
        <h2>Login</h2>
        <form action="{{route('user.login')}}" method="POST">
            @csrf
            <input type="text" placeholder="name" name="logingname">
            @error('logingname')
                <p>{{$message}}</p>
            @enderror
            <input type="password" placeholder="password" name="logingpassword">
            @error('logingpassword')
                <p>{{$message}}</p>
            @enderror
            <button>Login</button>
        </form>
    </div>
    @endauth
</body>
</html>