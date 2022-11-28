<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Image Face</label>
            <div class="col-sm-9">
                <input type="hidden" name="employee_id" id="employee_id" value="{{ request()->query('id') }}">
                <input type="file" name="file" id="file" class="filepond">
                <div class="invalid-feedback" id="file_error"></div>
                
            </div>
        </div>
    </div>
    
</div>

<button type="submit" class="btn btn-primary">{{ $button_name }}</button>

@push('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    $(document).ready(function () {
        FilePond.registerPlugin(FilePondPluginImagePreview);
                pond = FilePond.create(
                    document.querySelector('#file'), {
                        allowMultiple: false, //true if multiple
                        instantUpload: false,
                        allowImagePreview: true,
                        allowProcess: false
                    });
            
                $("#fromEmployeeFace").submit(function (e) {
                    e.preventDefault();
                    var fd = new FormData(this);
                    // append files array into the form data
                    pondFiles = pond.getFiles();
                    for (var i = 0; i < pondFiles.length; i++) {
                        fd.append('file', pondFiles[i].file);
                    }
                    $.ajax({
                            url: $(this).attr('action'),
                            type: $(this).attr('method'),
                            data: fd,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data) {
                                //    todo the logic
                                if(data.status=='success'){
                                    mynotif(data.msg);
                                    setTimeout(function() { 
                                      window.location.href=`/employee/{{ request()->query('id') }}/edit`;
                                    }, 3000);
                                }
                                // remove the files from filepond, etc
                            },
                            error: function(response,exception) {
                                $('.is-invalid').removeClass('is-invalid');
                                $('.invalid-feedback').text('');
                                        $.each(response.responseJSON, function(key, val) {
                                            $(`#${key}`).addClass('is-invalid');
                                            $(`#${key}_error`).text(val);
                                        });
                                    },
                        }
                    );
                });
            })
</script>
@endpush