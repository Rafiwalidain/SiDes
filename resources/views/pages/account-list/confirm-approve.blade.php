<div class="modal fade" id="confirmApprove-{{ $resident->id }}" tabindex="-1" aria-labelledby="confirmApproveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/account-requests/approval/{{ $resident->id }}" method="post">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="confirmApproveLabel">Konfirmasi Aktifkan</h4>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="for" value="activate">
                    <span>Apakah anda yakin akan meng-aktifkan akun ini?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ya, Aktifkan!</button>
                </div>
            </div>
        </form>
    </div>
</div>