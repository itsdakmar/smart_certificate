<div class="row justify-content-between">
    <div class="col-12">

        <h6 class="heading-small text-muted mb-4 ">{{ __('label.programme_documents') }}


            @hasanyrole('admin|secretariat')
            <button type="button" class="btn btn-sm btn-primary text-right ml-2" data-toggle="modal"
                    data-target="#uploadDocument"><i
                        class="fas fa-pencil-alt mr-1"></i> {{ __('label.edit')}}</button>
            @endhasanyrole

        </h6>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-borderless table-sm">
        @foreach($programme->documents as $document)
            <tr>
                <td><span class="text-uppercase">{{ $document->name }}</span></td>
                <td><a target="_blank" download href="{{ route('programme.get.document', $document->file_url) }}"> <span
                                class="font-weight-bold text-uppercase">Download Documents</span></a></td>
                @hasanyrole('admin|secretariat')
                <td>
                    <form action="{{ route('document.destroy', ['programme' => $programme, 'document' => $document]) }}"
                          method="post">
                        @csrf
                        @method('delete')

                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? this.parentElement.submit() : ''">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
                @endhasanyrole

            </tr>
            <tr>
                <td class="py-0" colspan="3">
                    <hr class="my-0">
                </td>
            </tr>

        @endforeach
    </table>
</div>