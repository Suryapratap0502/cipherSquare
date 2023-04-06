@include('includes/header')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-wrap">
                <form method="post" action="{{ url('task_one/update') }}" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="name-label" for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" value="{{ $data_edit['name'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="email-label" for="email">Email <small>*</small></label>
                                <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" value="{{ $data_edit['email'] }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="password-label" for="password">Password</label>
                                <input type="password" name="password" id="number" class="form-control" placeholder="Password" value="{{ $data_edit['password'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="image-label" for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control" onchange="upload()">
                                <img src="{{asset('upload/'.$data_edit['image'])}}" class="img-fluid wid-40" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="mobile-label" for="mobile">Mobile</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" value="{{ $data_edit['mobile'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="date-label" for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $data_edit['date'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="role-label" for="role">Select Role</label>
                                <select class="form-control form-select" name="role" id="role">
                                    <option value="" selected>Select</option>
                                    <option value="admin" @if($data_edit['role'] == 'admin' ){{'selected'}} @endif>Admin</option>
                                    <option value="user" @if($data_edit['role'] == 'user' ){{'selected'}} @endif>User</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="key" id="key" class="form-control" value="{{ $key }}">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" id="submit" class="btn btn-primary btn-block">Update</button>
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