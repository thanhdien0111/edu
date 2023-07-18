<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Article_title</th>
            <th>Essay</th>
           
            <th></th>
        </tr>
    </thead>
    <tbody class="alldata">
        @foreach ($data as $item)
        <tr>
            <td class="text-center align-middle"><input name='id[]' type="checkbox" id="checkItem" 
                value="{{$item->id}}">
            <td class="align-middle">{{$item->id}}</td>
            <td class="align-middle">{{$item->name}}</td>
            <td class="align-middle">{{$item->address}}</td>
            <td class="align-middle">{{$item->article_title}}</td>
            <td class="align-middle">{{$item->essay}}</td>
           
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                     <a  href="{{route("editessay",$item->id)}}" class="btn btn-warning">Edit</a>
                     <a id="deleteBtn"  href="{{route("deleteessay",$item->id)}}" class="btn btn-danger">Delete</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tbody id="content" class="searchdata">

    </tbody>
  </table>
  <div class="pagination">
    {!! $data->render()!!}
  </div>