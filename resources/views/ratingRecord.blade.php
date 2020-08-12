<html>
<table border="2">
    <thead>
    <tr>
        <th> id</th>
        <th> user ID</th>
        <th> movie ID  </th>
        <th> rating </th>
    </tr>
    </thead>
    <tbody>
    @foreach($ratings as $rating)
        <tr>
            <td> {{$rating->id}} </td>
            <td> {{$rating->user_id}} </td>
            <td> {{$rating->movie_id}} </td>
            <td> {{$rating->rating}} </td>
        </tr>
    @endforeach
    </tbody>
</table>
</html>
