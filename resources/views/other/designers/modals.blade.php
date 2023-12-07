<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex mb-3 justify-content-between ">
                    <h5 class="modal-title medium">Order Files</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="m-body">


                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex mb-3 justify-content-between ">
                    <h5 class="modal-title medium">Complete Design</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="m-body">
                    <div class="alert alert-success">
                        Congratulations on completing this order designs
                    </div>

                    <div class="alert alert-warning">
                        Please upload design files if available
                    </div>

                    <form action="/designer/complete_design" class="row" method="POST"
                        enctype="multipart/form-data">@csrf
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label text-muted mb-1 small">Upload File</label>
                                <div class="input-group border-bottom">
                                    <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                        id="basic-addon1"><i class="bx bxs-file bx-sm"></i></span>
                                    <input type="hidden" name="id">
                                    <input type="file" class="form-control bg-transparent border-0 rounded-0"
                                        placeholder="" name="files[]" aria-describedby="basic-addon1" multiple>

                                </div>

                                @error('files')
                                    <i class="text-danger ">{{ $message }} </i>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end ">
                                <button class="btn btn-success btn-sm">Mark as complete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="orderDesign" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex mb-3 justify-content-between ">
                    <h5 class="modal-title medium">Order Design</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="m-body">
                    <div class="alert alert-success">
                        Congratulations on completing this order designs
                    </div>

                    <div class="row" class="designs">
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
