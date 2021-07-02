@extends('layouts.AdminLayout')

<style>
    /* Image Designing Propoerties */
    .thumb {
        height: 200px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    }
    .cc{
        color: white;
    }
</style>


@section('content')

<a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a> >
    <a style="text-decoration:none" href="{{route('ProfileSettings')}}">&nbsp Account Settings &nbsp</a>>
    <a style="pointer-events: none" href="">&nbsp Change Profile Photo</a>
    <div style="float:right">
        <a class="btn btn-primary" href="{{route('ProfileSettings')}}">Back</a> |
        <a class="btn btn-primary" href="{{route('Home')}}">Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Account Settings</h4>

    <div class="row">
        <div class="col-md-4">
        <div class="card">
        <div class="card-header">
            <div class="card-title">Change Profile Photo</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <img id="myImg" src="https://www.lifewire.com/thmb/P856-0hi4lmA2xinYWyaEpRIckw=/1920x1326/filters:no_upscale():max_bytes(150000):strip_icc()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg" alt="your image" class="thumb">
                    </br>
                    <input type="file" name="picture" id="img" style="display:none;" /><br />
                </div>
            </div>
        </div>
        <div class="card-action">
        <label for="img" class="btn btn-primary cc">Upload image</label>
    </div>
        </div>
    </div>   

@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    /* The uploader form */
    $(function () {
        $(":file").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
        $('#myImg').attr('src', e.target.result);
        $('#yourImage').attr('src', e.target.result);
    };

</script>