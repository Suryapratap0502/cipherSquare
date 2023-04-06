@include('includes/header')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-wrap">
            @if($message = Session::get('success'))
                           <div class="alert alert-success">
                             <p>{{$message}}</p>
                          </div>
              @endif
                <form method="post" action="{{ url('task_one/add') }}" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="name-label" for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="email-label" for="email">Email <small>*</small></label>
                                <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="password-label" for="password">Password</label>
                                <input type="password" name="password" id="number" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="image-label" for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control" onchange="upload()">
                                <canvas id = "show_image" ></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="mobile-label" for="mobile">Mobile</label>
                                <input type="number" name="mobile" id="mobile" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="date-label" for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="role-label" for="role">Select Role</label>
                                <select class="form-control form-select" name="role" id="role">
                                    <option value="" selected>Select</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" id="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                    <br>
                    @if(count($errors))
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-12">
            @php $list_data = Session::get('session_data'); @endphp
            @if(!empty($list_data))
            <div class="form-wrap-1 table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Role</th>
                            <th scope="col">Password</th>
                            <th scope="col">Image</th>
                            <th scope="col">Date</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    @foreach($list_data as $key => $value)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $key +1 }}</th>
                            <td>{{ $value['name'] }}</td>
                            <td>{{ $value['email'] }}</td>
                            <td>{{ $value['mobile'] }}</td>
                            <td>{{ $value['role'] }}</td>
                            <td>{{ $value['password'] }}</td>
                            <td><img src="{{asset('upload/'.$value['image'])}}" alt="" style="width:40px;"></td>
                            <td>{{ $value['date'] }}</td>
                            <td><a href="{{ url('task_one/edit/'.$key+1) }}">Edit</a></td>
                            <td><a href="{{ url('task_one/delete/'.$key+1) }}" style="color:red;">Delete</a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <a href="{{ url('task_one/final_submit') }}"><button class="btn btn-primary btn-block">Final Submit</button></a>
            </div>
            @endif
        </div>
    </div>
</div>