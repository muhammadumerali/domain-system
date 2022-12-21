@extends('layouts.app')

@section('extra-css')

<style>
    .border-none{
        border: none;
    }
    .white{
        color: #ffffff;
    }
    .pagination{
        padding-top: 15px;
    }
</style>

@endsection




@section('content')
<div class="container">
    <div class="row justify-content-center">        
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex">
                        <div class="p-2"><h6>Registration State</h6></div>
                        <div class="px-2">
                            <select class="form-select">
                                @foreach(App\Models\Domain::DOMAIN_STATUSES as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="d-flex">
                        <div class="p-2"><h6>Contain Hyphens</h6></div>
                        <div class="px-2">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="d-flex">
                        <div class="p-2"><h6>Chars Count</h6></div>
                        <div class="px-2">
                            <input type="range" class="form-range" min="0" value="0">
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="d-flex">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </div>

            </div>

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Domain</th>
                    <th scope="col">State</th>
                    <th scope="col">Characters</th>
                    <th scope="col">Last Checked</th>
                    <th scope="col">Imported At</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($domains) == 0)
                    <tr><td colspan="7" class="text-center">No Record Found</td></tr>
                    @endif
                    
                    @foreach($domains as $domain)
                    <tr>
                        <td>{{ $domain->id }}</td>
                        <td>{{ $domain->domain }}</td>
                        <td>
                            @if($domain->status == 1)
                                <span class="badge bg-success">{{ App\Models\Domain::DOMAIN_STATUSES[$domain->status] }}</span>
                            @elseif($domain->status == 0)
                                <span class="badge bg-warning">{{ App\Models\Domain::DOMAIN_STATUSES[$domain->status] }}</span>
                            @elseif($domain->status == -1)
                                <span class="badge bg-danger">{{ App\Models\Domain::DOMAIN_STATUSES[$domain->status] }}</span>
                            @endif                            
                        </td>
                        <td>{{ $domain->char_counts }}</td>
                        <td>{{ is_null($domain->updated_at) ? 'N/A' : $domain->updated_at->format('d M, Y, h:i A') }}</td>
                        <td>{{ is_null($domain->created_at) ? 'N/A' : $domain->created_at->format('d M, Y, h:i A') }}</td>                        
                        <td>
                            <div class="d-flex">
                                <div class="px-1 mx-1 bg-warning">
                                    <a title="View Domain" href="#" class=""><i class="fa fa-eye  white"></i></a>
                                </div>
                                <div class="px-1 mx-1 bg-danger">
                                    <a title="Delete Domain" href="#" class="delete-domain" data-domain_id="{{ $domain->id }}"><i class="fa fa-trash-o white"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach                   

                    <tr colspan="7" class="pagination">
                        <td class="text-right border-none">{{ $domains->withQueryString()->links() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    $(document).on('click','.delete-domain',function(e){
        e.preventDefault();
        let id = $(this).attr('data-domain_id');        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                deletDomain(id);               
            }
        })
    });

    function deletDomain(id){
        //todo write ajax call to delete the domain        
    }//end of deletDomain()
</script>
@endsection
