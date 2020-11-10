<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    @csrf
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" id="id" name="id" value="{{ $tenant->id }}" hidden= "true" required="">
        </div>
    </div>
    <table class="col-sm-12">
        <tr>
            <td width="15%">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-label">Nama Tenant</label>
                    </div>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        <input placeholder="Nama Tenant" type="text" class="form-control" id="nama" name="nama" value="{{ $tenant->nama }}" required="">
                    </div>
                </div>
            </td>
            <td width="35%"></td>
        </tr>

        <tr>
            <td width="15%">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-label">Status</label>
                    </div>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        <div class="toggle">
                            @if ($tenant->status=='1')
                                <label class="form-switch">
                                    <input type="checkbox" value="1" name="status" checked><i></i>Aktif
                                </label>
                            @else
                                <label class="form-switch">
                                    <input type="checkbox" value="1" name="status"><i></i>Aktif
                                </label>
                            @endif
                        </div>
                    </div>
                </div>
            </td>
            <td width="35%"></td>
        </tr>
    </table>
</div>
<table class="col-sm-12">
    <tr>
        <td width="15%"></td>
        <td width="50%">
            <div class="form-group">
                <div class="col-sm-14">
                        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                        &nbsp;
                    <a href="{{ url('/master/tenant') }}" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </td>
        <td width="35%"></td>
    </tr>
</table>
