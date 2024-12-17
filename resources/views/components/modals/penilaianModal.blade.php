<div class="modal fade" id="penilaianModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="modalTitle">Penilaian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="penilaianForm" action="" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body" id="modalContent">
                    <div class="modal-body">
                        <input type="hidden" id="participantId" name="participant_id">
                        <input type="hidden" id="classId" name="class_id">
                        <h3 class="text-center text-bold">Peserta: <span id="participantName"></span>
                        </h3>
                        <dt class="text-center">Nama Burung: <span id="birdName"></span>
                        </dt>
                        <dd class="text-center">No Gantang: <span id="noGantang"></span>
                        </dd>
                        <h5 class="text-center text-bold">Nama Kelas: <span id="className"></span>
                        </h5>
                        <hr>
                        
                        <div id="scoreInputs"></div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="title" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
