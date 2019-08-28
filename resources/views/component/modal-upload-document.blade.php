<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('programme.document', ['id' => $programme_id]) }}"
                  enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label" for="document">Document Name</label>
                        <input type="text" class="form-control" id="document" name="document_name" aria-describedby="document"
                               placeholder="Enter Document Name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-current-password">{{ __('Choose File (PDF only)') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="document" id="inputGroupFile01"
                                       aria-describedby="inputGroupFileAddon01" accept="application/pdf" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>

