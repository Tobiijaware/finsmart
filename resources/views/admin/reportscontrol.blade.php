@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reports Control</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=".">Home</a></li>
                        <li class="breadcrumb-item active">Reports Control</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
{{--        <div class="col-lg-4">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title">Add Financial Reports</h3>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <form method="post" action="/addfinreports" id="form3">--}}
{{--                        @csrf--}}
{{--                        <label>Title</label>--}}
{{--                        <input id="title2" type="text" name="title" class="form-control" placeholder="Title" required/><br>--}}

{{--                        <label>Transaction Type</label>--}}
{{--                        <select name="type" class="form-control" id="type" required>--}}
{{--                            <option value="1">1</option>--}}
{{--                            <option value="2">2</option>--}}
{{--                            <option value="3">3</option>--}}
{{--                            <option value="4">4</option>--}}
{{--                            <option value="5">5</option>--}}
{{--                            <option value="6">6</option>--}}
{{--                            <option value="7">7</option>--}}
{{--                            <option value="8">8</option>--}}
{{--                            <option value="9">9</option>--}}
{{--                            <option value="10">10</option>--}}
{{--                            <option value="11">12</option>--}}
{{--                            <option value="12">12</option>--}}
{{--                            <option value="13">13</option>--}}
{{--                            <option value="14">14</option>--}}
{{--                            <option value="15">15</option>--}}
{{--                            <option value="16">16</option>--}}
{{--                            <option value="17">17</option>--}}
{{--                            <option value="18">18</option>--}}
{{--                            <option value="19">19</option>--}}
{{--                            <option value="20">20</option>--}}
{{--                            <option value="21">21</option>--}}
{{--                            <option value="22">22</option>--}}
{{--                            <option value="23">23</option>--}}
{{--                            <option value="24">24</option>--}}
{{--                            <option value="25">25</option>--}}
{{--                            <option value="26">26</option>--}}
{{--                            <option value="27">27</option>--}}
{{--                            <option value="28">28</option>--}}
{{--                            <option value="29">29</option>--}}
{{--                            <option value="30">30</option>--}}
{{--                        </select>--}}

{{--                        <label>SMS</label>--}}
{{--                        <input type="text" name="sms" class="form-control" placeholder="sms"><br>--}}
{{--                        <button class="btn btn-block btn-outline-primary" type="submit">Add</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-lg-12">
            <div class="card">


                <div class="card-body">
                    <div>

                            <table class="table">
                                <thead>
                                <tr>

                                    <th scope="col">Title</th>
{{--                                <th scope="col">Mode</th>--}}
                                    <th scope="col">Activate</th>
                                    <th scope="col">De-Activate</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                @foreach($data as $key)
                                <tbody>
                                <tr>
                                    <td>{{$key->title}}</td>
{{--                                   <td><?php echo reportCheck($key->sn) ?></td>--}}
                                    <td>
                                        <form method="post" action="/activatereport" onclick="submit()">
                                            @csrf
                                            <input value="{{$key->sn}}" type="checkbox" name="active" <?php if(reportCheck($key->sn,'active')==1){echo 'checked'; } ?>>
                                        </form>

                                    </td>
                                    <td>
                                        <form method="post" action="/deactivatereport" onclick="submit()">
                                            @csrf
                                            <input value="{{$key->sn}}" type="checkbox" name="deactive" <?php if(reportCheck($key->sn,'active')==0){echo 'checked'; } ?>>
                                        </form>

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#exampleModal{{$key->sn}}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                </tbody>

                                    <div class="modal fade" id="exampleModal{{$key->sn}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Edit Content</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="/editreport">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div>
                                                            <label for="title">Title</label>
                                                            <input type="text" class="form-control" name="title" value="{{$key->title}}" placeholder="Title"><br>

                                                            <label for="sms">SMS</label>
                                                            <input type="text" class="form-control" name="sms" value="{{$key->sms}}" placeholder="SMS">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="editreport" value="{{$key->sn}}" class="btn btn-outline-primary">Save changes</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>


//        let title2 = document.querySelector('#title2');
//        let type = document.querySelector('#type');
//
//        title2.addEventListener('onkeyup', function(e){
//            e.preventDefault();
//            console.log('hello');
//        })
//
//        console.log();

    </script>




@endsection
