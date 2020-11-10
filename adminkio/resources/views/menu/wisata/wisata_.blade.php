<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    @csrf
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" id="id" name="id" value="{{ $wisata->id }}" hidden= "true" required="">
        </div>
    </div>
    <table class="col-sm-12">
        <tr>
            <td width="15%">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-label">Nama Wisata</label>
                    </div>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        <input placeholder="Nama Wisata" type="text" class="form-control" id="nama" name="nama" value="{{ $wisata->nama }}" required="">
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
                        <textarea placeholder="Deskripsi" style="height:150px" class="form-control" id="deskripsi" name="deskripsi" value="" required="">{{ $wisata->deskripsi }}</textarea>
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
                        <textarea placeholder="English Description" style="height:150px" class="form-control" id="deskripsi_en" name="deskripsi_en" value="">{{ $wisata->deskripsi_en }}</textarea>
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
                        <iframe src="{{ $wisata->lokasi }}"></iframe>
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
                        <textarea placeholder="Lokasi" style="height:200px" class="form-control" id="lokasi" name="lokasi" value="" required="">{{ $wisata->lokasi }}</textarea>
                        <label style="color:red;"><b>*Salin link url embeded maps dari google maps</b></label>
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
                            <img style="width:30%;" name="a" value="{{ $wisata->qrlink }}" src="{{ asset('gambar/wisata/qr/'.$wisata->qrlink) }}" alt="{{ $wisata->qrlink }}" class="img-fluid">
                    </div>
                </div>
            </td>
            <td width="35%"></td>
        </tr>
        <tr>
            <td width="15%">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-label">Link Lokasi</label>
                    </div>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        <input placeholder="Link Lokasi" type="text" class="form-control" id="aa" name="aa" value="{{ $wisata->qrlink }}" hidden="true">
                        <input placeholder="Link Lokasi" type="text" class="form-control" id="link" name="link" disabled="true">
                    </div>
                </div>
            </td>
            <td width="35%">
                <div class="form-group">
                    <div class="col-sm-14">
                            <button onclick="edit()" id="btnqr" class="btn btn-warning">Edit Link</button>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td width="15%"></td>
            <td width="50%">
                <div class="form-group">
                    <div class="col-sm-14">
                        @if ($wisata->image =="no-image")
                            <img style="width:30%;" name="foto" value="{{ $wisata->image }}" src="{{ asset('gambar/tenant/no-thumb.jpg') }}" alt="{{ $wisata->image }}" class="img-fluid">
                        @else
                            <img style="width:30%;" name="foto" value="{{ $wisata->image }}" src="{{ asset('gambar/wisata/' . $wisata->image) }}" alt="{{ $wisata->image }}" class="img-fluid">
                        @endif
                            <input type="text" class="form-control" id="gb" name="gb" value="{{ $wisata->image }}" hidden= "true" required="">
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
                        <input type="file" value="" placeholder="Image" id="image" name="image">
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
                            @foreach ($cbw as $item)
                                @if ($wisata->type)
                                    <option value="{{ $item->poss_id }}" {{ $item->poss_id == $wisata->type ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endif
                            @endforeach
                        </select>
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
                            @if ($wisata->status=='1')
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
                    <a href="{{ url('/wisata') }}" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </td>
        <td width="35%"></td>
    </tr>
</table>

<script>
        var x = document.getElementById('btnqr');
        x.onclick = function edit(){
            document.getElementById('link').disabled=false;
            document.getElementById('link').focus();
            x.disabled = true;
        }
    </script>
