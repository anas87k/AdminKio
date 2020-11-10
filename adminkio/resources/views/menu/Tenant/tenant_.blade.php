<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        @csrf
        <div class="form-group">
            <div class="col-sm-12">
                <input placeholder="Nama Tenant" type="text" class="form-control" id="id" name="id" value="{{ $tenants->id }}" hidden= "true" required="">
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
                            <input placeholder="Nama Tenant" type="text" class="form-control" id="name_tenant" name="name_tenant" value="{{ $tenants->name_tenant }}" required="">
                        </div>
                    </div>
                </td>
                <td width="35%"></td>
            </tr>

            {{-- <tr>
                <td width="15%">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="form-label">Lantai 1</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            <select  name="lantai_1" id="select-type" class="form-control custom-select" required="">
                                @if ($tenants->lantai_1 =='1'){
                                    <option value="1" selected>Ya</option>
                                    <option value="0">Tidak</option>
                                }
                                @else {
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                }
                                @endif
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
                            <label class="form-label">Lantai 2</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            <select  name="lantai_2" id="select-type" class="form-control custom-select" required="">
                                @if ($tenants->lantai_2 =='1'){
                                    <option value="1" selected>Ya</option>
                                    <option value="0">Tidak</option>
                                }
                                @else {
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                }
                                @endif
                            </select>
                        </div>
                    </div>
                </td>
                <td width="35%"></td>
            </tr> --}}

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
                                    @if ($tenants->lantai_1 =='1')
                                        <input type="checkbox" name="lantai_1" value="1" class="selectgroup-input" checked>

                                    @else
                                        <input type="checkbox" name="lantai_1" value="1" class="selectgroup-input">
                                    @endif
                                    <span class="selectgroup-button">Lantai 1</span>
                                </label>
                                <label class="selectgroup-item">
                                    @if ($tenants->lantai_2 =='1')
                                        <input type="checkbox" name="lantai_2" value="1" class="selectgroup-input" checked>

                                    @else
                                        <input type="checkbox" name="lantai_2" value="1" class="selectgroup-input">
                                    @endif
                                    <span class="selectgroup-button">Lantai 2</span>
                                </label>
                                <label class="selectgroup-item">
                                    @if ($tenants->mezanine =='1')
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
                            <textarea placeholder="Deskripsi" style="height:100px;" class="form-control" id="deskripsi" name="deskripsi" value="" required="">{{ $tenants->deskripsi }}</textarea>
                        </div>
                    </div>
                </td>
                <td width="35%"></td>
            </tr>

            <tr>
                <td width="15%">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="form-label">English Desription</label>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="form-group">
                        <div class="col-sm-14">
                            <textarea placeholder="Deskripsi" style="height:100px;" class="form-control" id="deskripsi_en" name="deskripsi_en" value="" required="">{{ $tenants->deskripsi_en }}</textarea>
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
                                    @foreach ($cbt as $item)
                                    @if ($tenants->type)
                                        <option value="{{ $item->poss_id }}" {{ $item->poss_id == $tenants->type ? 'selected' : '' }}>{{ $item->nama }}</option>
                                    @endif
                                    @endforeach
                                {{-- @if ($tenants->type =='1'){
                                    <option value="1" selected>Tenant</option>
                                    <option value="2">F&B</option>
                                    <option value="3">Retail</option>
                                }
                                @elseif ($tenants->type =='2'){
                                    <option value="1">Tenant</option>
                                    <option value="2" selected>F&B</option>
                                    <option value="3">Retail</option>
                                }
                                @else {
                                    <option value="1">Tenant</option>
                                    <option value="2">F&B</option>
                                    <option value="3" selected>Retail</option>
                                }
                                @endif --}}
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
                            @if ($tenants->image =="no-image")
                                <img style="width:35%;" name="foto" value="no-thumb.jpg" src="{{ asset('gambar/tenant/no-thumb.jpg') }}" class="img-fluid">
                            @else
                                <img style="width:35%;" name="foto" value="{{ $tenants->image }}" src="{{ asset('gambar/tenant/' . $tenants->image) }}" alt="{{ $tenants->image }}" class="img-fluid">
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
                                <input placeholder="Nama Tenant" type="text" class="form-control" id="gb" name="gb" value="{{ $tenants->image }}" hidden= "false" required="">
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-14">
                            <input type="file" value="{{ $tenants->image }}" placeholder="Image" id="image" name="image" value="">
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
                                    @if ($tenants->status=='1')
                                        <label class="form-switch">
                                            <input type="checkbox" value="1" name="status" checked><i></i>Aktif
                                        </label>
                                    @else
                                        <label class="form-switch">
                                            <input type="checkbox" value="1" name="status"><i></i>Aktif
                                        </label>
                                    @endif
                                </div>
                            {{-- <label class="custom-switch">
                                @if ($tenants->status=='1')
                                    <input type="checkbox" name="status" value="1" class="custom-switch-input" checked>
                                @else
                                    <input type="checkbox" name="status" value="1" class="custom-switch-input">
                                @endif
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Aktif</span>
                            </label> --}}
                            {{-- <select name="status" id="select-type" class="form-control custom-select">
                                    @if ($tenants->status =='1'){
                                        <option value="1" selected>Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    }
                                    @else {
                                        <option value="1">Aktif</option>
                                        <option value="0" selected>Tidak Aktif</option>
                                    }
                                    @endif
                            </select> --}}
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
                    <a href="{{ url('/tenant') }}" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </td>
        <td width="35%"></td>
    </tr>
</table>
