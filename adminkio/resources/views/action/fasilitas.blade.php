{!! Form::model($model, ['url'=>$form_url, 'method'=>'delete', 'class'=>'form-inline']) !!}
<a href="{!! $edit_url !!}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
&nbsp;&nbsp;
{!! Form::button('<i class="fa fa-trash-o"></i>', ['type'=>'submit','onclick'=>'return myFunction();','class'=>'btn btn-sm btn-danger']) !!}
{!! Form::close() !!}


<script>
    function myFunction() {
        if(!confirm("Apakah anda yakin menghapus data ini?"));
        event.preventDefault();
    }
</script>
