<div class="container">
    @if ($count)
         <!--begin::Advance Table Widget 3-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">@yield('title')<span class="text-muted mt-3 font-weight-bold font-size-sm"> ({{ $count }})</span></span>
                </h3>
                <a href="#" data-toggle="modal" data-target=".create" class="btn btn-primary btn-shadow font-weight-bold mr-2 "><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0 pb-3">

                <div class="mb-5 ">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input 
                                            wire:model="search"
                                            type="search" 
                                            class="form-control"
                                            placeholder="Buscar...">
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Mostrar:</label>
                                        <select class="form-control" wire:model="perPage">
                                            <option value="10">10 Entradas</option>
                                            <option value="20">20 Entradas</option>
                                            <option value="50">50 Entradas</option>
                                            <option value="100">100 Entradas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead>
                            <tr class="text-uppercase">
                                <th>Proveedor</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($providers as $provider)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50 mr-3">
                                                <img 
                                                    alt="{{ $provider->name }}" 
                                                    @if ($provider->image)
                                                        src="{{ Storage::url($provider->image->url) }}" 
                                                    @else
                                                        src="{{ asset('assets/media/users/blank.png') }}" 
                                                    @endif
                                                    >
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $provider->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $provider->description }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left"  style="position: initial!important;">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="position: inherit;">
                                                    <!--begin::Navigation-->
                                                    <ul class="navi navi-hover py-5">
                                                        <li class="navi-item" data-toggle="modal" data-target="#edit-{{ $provider->id }}">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fa fa-pen"></i>
                                                                </span>
                                                                <span class="navi-text">Editar</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item" onclick="event.preventDefault(); confirmDestroy({{ $provider->id }})">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                                <span class="navi-text">Eliminar</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!--end::Navigation-->
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include('provider.edit')
                            @empty 
                                <!--begin::Col-->
                                <div class="col-12">
                                    <div class="alert alert-custom alert-notice alert-light-dark fade show mb-5" role="alert">
                                        <div class="alert-icon">
                                            <i class="flaticon-questions-circular-button"></i>
                                        </div>
                                        <div class="alert-text">Sin resultados "{{ $search }}"</div>
                                    </div>
                                </div>
                           @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->

                {{ $providers->links() }}

            </div>
            <!--end::Body-->
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-5">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun proveedor.
                    <br> Ponga en marcha su CRM añadiendo su primer proveedor</p>
                    <a data-toggle="modal" data-target=".create" href="#" class="btn btn-primary">Agregar proveedor</a>
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/providers.png') }}">
                </div>
            </div>
        </div>
    @endif

    @include('provider.create')

    @section('footer')
        <script>

            Livewire.on('closeModal', function(){
                $('.modal').modal('hide');
            });

            function confirmDestroy(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este proveedor y los gastos creados con este proveedor se quedarán sin proveedor",
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fa fa-trash'></i> <span class='text-white'>Si, eliminar</span>",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i> <span class='text-dark'>No, cancelar</span>",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-secondary font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                    showLoaderOnConfirm: true,
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('destroy', id);
                    }
                });
            }
            
        </script>
    @endsection
</div>