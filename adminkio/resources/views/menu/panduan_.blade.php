<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    @csrf
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" id="id" name="id" value="{{ $panduan->id }}" hidden= "true" required="">
        </div>
    </div>
    <table class="col-sm-12">
        <tr>
            <td width="15%">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-label">Nama Panduan</label>
                    </div>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        <input placeholder="Nama Panduan" type="text" class="form-control" id="post_title" name="post_title" value="{{ $panduan->post_title }}" required="">
                    </div>
                </div>
            </td>
            <td width="35%"></td>
        </tr>

        <tr>
            <td width="15%">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-label">Guide Name</label>
                    </div>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        <input placeholder="Guide Name (English)" type="text" class="form-control" id="en_title" name="en_title" value="{{ $panduan->en_title }}">
                    </div>
                </div>
            </td>
            <td width="35%"></td>
        </tr>

        <tr>
            <td width="15%">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-label">Deskripsi</label>
                    </div>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        <textarea placeholder="Deskripsi" style="height:200px" class="form-control" id="post_desc" name="post_desc" value="" required="">{{ $panduan->post_desc }}</textarea>
                    </div>
                </div>
            </td>
            <td width="35%"></td>
        </tr>

        <tr>
            <td width="15%">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-label">English Description</label>
                    </div>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        <textarea placeholder="English Description" style="height:200px" class="form-control" id="en_desc" name="en_desc" value="">{{ $panduan->en_desc }}</textarea>
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
                            @if ($panduan->status=='1')
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
                    <a href="{{ url('/panduan') }}" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </td>
        <td width="35%"></td>
    </tr>
</table>
