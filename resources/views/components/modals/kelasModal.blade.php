<div class="modal fade" id="kelasModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="modalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="kelasForm" action="{{ route('class.store') }}" method="POST">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="class_id" name="class_id">
                <div class="modal-body" id="modalContent">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Nama Class</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan nama class" required>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Perlombaan</label>
                                    <select class="form-control" id="competition_id" name="competition_id" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Pilih Juri</label><br>
                                    <div id="judgesList">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Criteria</label><br>
                                    <div id="criteriaList">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitBtn" class="btn btn-warning"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
