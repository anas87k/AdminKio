<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        @csrf
        <div class="form-group">
            <div class="col-sm-12">
                <input placeholder="Nama Tenant" type="text" class="form-control" id="id" name="id" value="{{ $asistens->id }}" hidden= "true" required="">
            </div>
        </div>

        <table class="col-sm-12">
            <tr>
                <td width="15%">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="form-label">Nama</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            <input placeholder="Nama" type="text" class="form-control" id="name" name="name" value="{{ $asistens->name }}" required="">
                        </div>
                    </div>
                </td>
                <td width="35%"></td>
            </tr>

            <tr>
                <td width="15%">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="form-label">Name</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            <input placeholder="Name (English)" type="text" class="form-control" id="name_en" name="name_en" value="{{ $asistens->name_en }}">
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
                            <textarea placeholder="Deskripsi" style="height:100px;" class="form-control" id="deskripsi" name="deskripsi" value="" required="">{{ $asistens->deskripsi }}</textarea>
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
                            <textarea placeholder="English Description" style="height:100px;" class="form-control" id="deskripsi_en" name="deskripsi_en" value="">{{ $asistens->deskripsi_en }}</textarea>
                        </div>
                    </div>
                </td>
                <td width="35%"></td>
            </tr>

            <tr>
                <td width="15%">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="form-label">Type</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            <select  name="type" id="select-type" class="form-control custom-select" required="">
                                @foreach ($cba as $item)
                                    @if ($asistens->type)
                                        <option value="{{ $item->poss_id }}" {{ $item->poss_id == $asistens->type ? 'selected' : '' }}>{{ $item->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
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
                            @if ($asistens->image =="no-image")
                                <img style="width:30%;" name="foto" value="{{ $asistens->image }}" src="{{ asset('gambar/tenant/no-thumb.jpg') }}" alt="{{ $asistens->image }}" class="img-fluid">
                            @else
                                <img style="width:30%;" name="foto" value="{{ $asistens->image }}" src="{{ asset('gambar/assistance/' . $asistens->image) }}" alt="{{ $asistens->image }}" class="img-fluid">
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
                                <input placeholder="Nama Tenant" type="text" class="form-control" id="gb" name="gb" value="{{ $asistens->image }}" hidden= "true">
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-14">
                            <input type="file" value="{{ $asistens->image }}" placeholder="Image" id="image" name="image" value="">
                        </div>
                    </div>
                </td>
                <td width="35%"></td>
            </tr>

            <tr>
                    <td width="15%">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="form-label">Video</label>
                            </div>
                        </div>
                    </td>
                    <td width="50%">
                        <div class="form-group">
                                <div class="col-sm-14">
                                    <input placeholder="Nama Tenant" type="text" class="form-control" id="vd" name="vd" value="{{ $asistens->video }}" hidden= "true">
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-sm-14">
                                <input type="file" value="{{ $asistens->video }}" placeholder="Video" id="video" name="video" value="">
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
                                @if ($asistens->status=='1')
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
                    <a href="{{ url('/asisten') }}" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </td>
        <td width="35%"></td>
    </tr>
</table>
