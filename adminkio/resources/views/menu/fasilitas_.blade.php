<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        @csrf
        <div class="form-group">
            <div class="col-sm-12">
                <input placeholder="Nama Tenant" type="text" class="form-control" id="no" name="no" value="{{ $fasilitas->id }}" hidden= "true" required="">
            </div>
        </div>

        <table class="col-sm-12">
            <tr>
                <td width="15%">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="form-label">Nama Fasilitas</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            <input placeholder="Nama Fasilitas" type="text" class="form-control" id="nama" name="nama" value="{{ $fasilitas->nama }}" required="">
                        </div>
                    </div>
                </td>
                <td width="35%"></td>
            </tr>
            <tr>
                <td width="15%">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="form-label">Lokasi</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                    @if ($fasilitas->lantai_1 =='1')
                                        <input type="checkbox" name="lantai_1" value="1" class="selectgroup-input" checked>

                                    @else
                                        <input type="checkbox" name="lantai_1" value="1" class="selectgroup-input">
                                    @endif
                                    <span class="selectgroup-button">Lantai 1</span>
                                </label>
                                <label class="selectgroup-item">
                                    @if ($fasilitas->lantai_2 =='1')
                                        <input type="checkbox" name="lantai_2" value="1" class="selectgroup-input" checked>

                                    @else
                                        <input type="checkbox" name="lantai_2" value="1" class="selectgroup-input">
                                    @endif
                                    <span class="selectgroup-button">Lantai 2</span>
                                </label>
                                <label class="selectgroup-item">
                                    @if ($fasilitas->mezanine =='1')
                                        <input type="checkbox" name="mezanine" value="1" class="selectgroup-input" checked>

                                    @else
                                        <input type="checkbox" name="mezanine" value="1" class="selectgroup-input">
                                    @endif
                                    <span class="selectgroup-button">Mezanine</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </td>
                <td width="35%"></td>
            </tr>

            <tr>
                <td width="15%"></td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            @if ($fasilitas->foto =="no-image")
                                <img style="width:35%;" name="foto" value="no-thumb.jpg" src="{{ asset('gambar/tenant/no-thumb.jpg') }}" class="img-fluid">
                            @else
                                <img style="width:35%;" name="foto" value="{{ $fasilitas->foto }}" src="{{ asset('gambar/fasilitas/' . $fasilitas->foto) }}" alt="{{ $fasilitas->foto }}" class="img-fluid">
                            @endif
                        </div>
                    </div>

                </td>
                <td width="35%"></td>
            </tr>

            <tr>
                <td width="15%">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="form-label">Gambar</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                            <div class="col-sm-14">
                                <input placeholder="Nama Tenant" type="text" class="form-control" id="gb" name="gb" value="{{ $fasilitas->foto }}" hidden= "True">
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-14">
                            <input type="file" value="{{ $fasilitas->foto }}" placeholder="Image" id="image" name="image" value="">
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
                                    @if ($fasilitas->status=='1')
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
                <div class="col-sm-offset-2 col-sm-14">
                        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                        &nbsp;
                    <a href="{{ url('/fasilitas') }}" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </td>
        <td width="35%"></td>
    </tr>
</table>
