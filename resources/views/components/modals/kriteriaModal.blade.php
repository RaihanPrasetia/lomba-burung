<div class="modal fade" id="kriteriaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="modalTitle">Kriteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="kriteriaForm" action="" method="POST">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">
                <div class="modal-body" id="modalContent">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Nama Criteria</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan nama criteria" required>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Bobot (0-1)</label>
                                    <input type="number" step="any" class="form-control" id="weight"
                                        name="weight" placeholder="Masukkan bobot criteria (contoh: 0.5)" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="benefit">Benefit</option>
                                    </select>
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
