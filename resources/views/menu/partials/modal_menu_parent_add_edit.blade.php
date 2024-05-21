<div class="modal fade" id="modal-default-parent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title-parent"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_header">
                <input type="hidden" class="form-control" id="id_parent">


                <div class="form-group">
                    <label for="nama_menu_parent">Nama</label>
                    <input type="text" class="form-control" id="nama_menu_parent" placeholder="Nama">
                </div>

                <div class="form-group">
                    <label for="url_parent">URL</label>
                    <input type="text" class="form-control" id="url_parent" placeholder="URL">
                </div>

                <div class="form-group">
                    <label for="urut_menu_parent">Urut</label>
                    <input type="text" class="form-control" id="urut_menu_parent" placeholder="Urut">
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button data-dismiss="modal" class="btn btn-{{ getButton('close', 'color') }}"><i
                        class="fas fa-{{ getButton('close', 'icon') }}"></i> {{ getButton('close', 'title') }}</button>
                <button id="save_menu_parent" class="btn btn-{{ getButton('save', 'color') }}"><i
                        class="fas fa-{{ getButton('save', 'icon') }}"></i> {{ getButton('save', 'title') }}</button>
            </div>
        </div>
    </div>
</div>
