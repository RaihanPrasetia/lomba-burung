<div class="modal fade" id="perlombaanModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="modalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="perlombaanForm" action="" method="POST">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">
                <div class="modal-body" id="modalContent">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Nama Perlombaan</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan nama perlombaan" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Akan Datang">Akan Datang</option>
                                        <option value="Berlangsung">Berlangsung</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pdf_link">Link Pdf</label>
                                    <input type="url" class="form-control" id="pdf_link" name="pdf_link"
                                        placeholder="Masukan link pdf" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="title" class="btn btn-warning"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
