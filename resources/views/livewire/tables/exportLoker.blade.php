<button class="btn btn-success" id="btn-confirm"><i class="fa fa-file-excel-o p-1"></i> Export Excel
</button>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Export Lowongan - Kerja</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin export record ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal-btn-yes"
                    wire:click='exportLoker()'>Yes</button>
                <button type="button" class="btn btn-danger" id="modal-btn-no">No</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var modalConfirm = function(callback) {

            $("#btn-confirm").on("click", function() {
                $("#mi-modal").modal('show');
            });

            $("#modal-btn-yes").on("click", function() {
                callback(true);
                $("#mi-modal").modal('hide');
            });

            $("#modal-btn-no").on("click", function() {
                callback(false);
                $("#mi-modal").modal('hide');
            });
        };

        modalConfirm(function(confirm) {
            if (confirm) {
                $("#result").html("confirm");
            } else {
                $("#result").html("no confirm");
            }
        });
    </script>
@endpush
