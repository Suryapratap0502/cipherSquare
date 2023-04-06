@include('includes/header')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card rounded-0 border-0 shadow">
                <div class="card-body p-5">
                    <form id="update_row_data">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        @if(!empty($columnCount))
                                        @foreach($columnCount as $value)
                                        <th scope="col">{{ $value }}</th>
                                        <input type="hidden" id="column_name" name="column_name[]" value="{{ $value }}">
                                        @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($coloumn_two))
                                    @foreach($coloumn_two as $values)
                                    <input type="hidden" id="row_id" name="row_id[]" value="{{ $values->id }}">
                                    <tr>
                                        @if(!empty($columnCount))
                                        @foreach($columnCount as $value)
                                        <th><input type="text" class="form-control custom_width" name="row_{{$values->id}}_{{$value}}" value="{{ $values->$value }}"></th>
                                        @endforeach
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <input type="submit" class="btn btn-primary rounded-0 btn-block" value="Update">
                        <a class="btn btn-primary rounded-0 btn-block" onclick="add_coloumn('{{ $finel_count +1 }}')" style="float:right;">Add New Coloumn</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('submit', '#update_row_data', function(ev) {
        ev.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: base_url + 'task_two/update',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function(result) {
                if (result.code == 200) {
                    alert(result.message);
                }
                else if(result.code == 400)
                {
                    alert(result.message);
                }
            },
            cache: false,
            contentType: false,
            processData: false,

        })
    })
</script>