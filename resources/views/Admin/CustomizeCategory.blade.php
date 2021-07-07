@extends('layouts.AdminLayout')

@section('content')

<style>
    .button-group {
        margin: auto;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

</style>

    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a> >
    <a style="pointer-events: none" href="">&nbsp Customize Category</a>
    <div style="float:right">
        <a class="btn btn-primary" href="{{route('Home')}}">Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Customize Categroy</h4>

    <div class="card">
        <div class="card-header">
            <div class="card-title">Customize Category</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th style="width:30%" scope="col">#</th>
                            <th style="width:35%">Category</th>
                            <th style="width:35%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $item)
                        <tr id="deleteCategory{{$item['categoryId']}}">
                            <th scope="row">{{$item['categoryId']}}</th>
                            <td id="done{{$item['categoryId']}}">{{$item['categoryName']}}</td>
                            <td>
                                <button class="btn btn-success rounded-0 update" id="update{{$item['categoryId']}}" data-id="{{$item['categoryId']}}">Update</button> &nbsp
                                <button class="btn btn-danger rounded-0 delete" id="delete{{$item['categoryId']}}" data-id="{{$item['categoryId']}}">Delete</button>
                            </td>
                        </tr>
                        <tr id="updateRow{{$item['categoryId']}}" style="display:none">
                            <th></th>
                            <td>
                                <input type="text" class="form-control input-square" name="categoryName{{$item['categoryId']}}" id="categoryName{{$item['categoryId']}}" value="{{$item['categoryName']}}">
                                <span class="text-danger">@error('categoryName') {{ $message }} @enderror</span>
                                <span class="text-danger" id="categoryNameError"></span>

                            </td>
                            <td>
                                <button class="btn btn-outline-success btn-sm rounded-0 updated" id="updated{{$item['categoryId']}}" data-id="{{$item['categoryId']}}"><i class="la la-check" aria-hidden="true"></i>&nbsp Done</button> &nbsp
                                <button class="btn btn-outline-danger btn-sm rounded-0" id="cancel{{$item['categoryId']}}"><i class="la la-times"></i>&nbsp Cancel</button>
                            </td>
                        </tr>
                        <tr id="deleteRow{{$item['categoryId']}}" style="display:none">
                            <th></th>
                            <td>
                                <p><span class=text-danger>*</span>Are You Sure Want To Delete??</p>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-sm rounded-0 deleted" id="deleted{{$item['categoryId']}}" data-id="{{$item['categoryId']}}"><i class="la la-times"></i>Yes</button>&nbsp
                                <button class="btn btn-outline-success btn-sm rounded-0" id="no{{$item['categoryId']}}"><i class="la la-check" aria-hidden="true"></i>&nbsp No</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="mb-3 button-group">
                <div class="btn-group" aria-label="First group">
                    @if(Request::get('id')!=0)
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => -1]) }}"><<</a>
                    @endif
                    @for( $i = 0; $i<$totalRow/5; $i++)
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => $i]) }}">{{($i+1)}}</a>
                    @endfor
                    @if(Request::get('id')!=ceil($totalRow/5)-1)
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => -2]) }}">>></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        $(document).ready(function(){

            $(`.update`).click(function(){

                var id = $(this).data('id')

                $(`#deleteRow${id}`).hide()

                $(`#updateRow${id}`).show()

                $(`#cancel${id}`).click(function(){

                    $(`#updateRow${id}`).hide()

                })

            })

            $(`.delete`).click(function(){

                var id = $(this).data('id')

                $(`#updateRow${id}`).hide()

                $(`#deleteRow${id}`).show()

                $(`#no${id}`).click(function(){

                    $(`#deleteRow${id}`).hide()

                })

            })

            $(`.updated`).click(function(){

                var categoryId=$(this).data('id')

                $.ajax({
                    url:`https://scenic-north-cascades-18021.herokuapp.com/api/updateCategory/${categoryId}`,
                    method:"PUT",
                    data:{
                        "catehoryId": categoryId,
                        "categoryName": $("#categoryName"+categoryId).val(),
                    },
                    complete:function(xmlHttp,status){
                        if(xmlHttp.status==200)
                        {
                            $(`#updateRow${categoryId}`).hide()
                            $("#done"+categoryId).html($("#categoryName"+categoryId).val());
                        }
                        else
                        {
                            alert("Error");
                        }
                    }
                })

            })

            $(`.deleted`).click(function(){

                var categoryId=$(this).data('id')

                $.ajax({
                    url:`https://scenic-north-cascades-18021.herokuapp.com/api/deleteCategory/${categoryId}`,
                    method:"Delete",
                    complete:function(xmlHttp,status){
                        if(xmlHttp.status==204)
                        {
                            $(`#deleteCategory${categoryId}`).remove()
                            $(`#updateRow${categoryId}`).remove()
                            $(`#deleteRow${categoryId}`).remove()
                        }
                        else
                        {
                            alert("Error");
                        }
                    }
                })

            })

        });

    </script>


@stop
