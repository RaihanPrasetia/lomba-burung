<div class="modal fade" id="pesertaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="modalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form id="competitionForm" style="display: none">
                        <label for="competition_id">Kompetisi</label>
                        <select name="competition_id" id="competition_id" class="form-control"
                            onchange="filterClasses()" required>
                            <option value="">Pilih Kompetisi</option>
                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}" data-status="{{ $competition->status }}">
                                    {{ $competition->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <form id="pesertaForm" action="{{ route('peserta.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="method" name="_method" value="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="NamaLengkap">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" id="name" name="name" placeholder="Nama Lengkap"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="NamaBurung">Nama Burung</label>
                                <input type="text" class="form-control @error('bird_name') is-invalid @enderror"
                                    id="bird_name" name="bird_name" value="{{ old('bird_name') }}"
                                    placeholder="Nama burung" required>
                            </div>
                            <div class="form-group">
                                <label for="no_gantang">No Gantang</label>
                                <input type="number" class="form-control @error('no_gantang') is-invalid @enderror"
                                    id="no_gantang" name="no_gantang" value="{{ old('no_gantang') }}"
                                    placeholder="No gantang" required>
                                @error('no_gantang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="contact_info">Kontak</label>
                                <input type="number" class="form-control @error('contact_info') is-invalid @enderror"
                                    id="contact_info" name="contact_info" value="{{ old('contact_info') }}"
                                    placeholder="Nomor telepon" required>
                            </div>
                            <div class="form-group" id="class" style="display: none">
                                <label>Pilih Kelas</label><br>
                                <div id="classOptions">
                                    <!-- Kelas akan dimuat di sini dengan AJAX -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="title" class="btn btn-warning"></button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
