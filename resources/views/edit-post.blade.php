<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit post</h1>
    <form action="{{route('post.edit', ['post'=> $post])}}" method="POST">
        @csrf
        @method('PUT')


        <input type="text" name="tittle" value="{{$post->tittle}}">
        <textarea name="body" >{{$post->body}}</textarea>
        <button> edit post</button>
        
    </form>
</body>
</html>