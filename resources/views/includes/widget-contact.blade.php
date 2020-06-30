
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <a href="{{ route('contact.create') }}" class="btn btn-primary btn_right_new" type="button">
                                                Nueva
                                            </a>
                                        </div>
                                        <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar contacto..." style="border:1px solid #0087ff;">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-label-group">
                                        <select class="form-control" id="type-contact" name="etiquetas">
                                            <option>Busqueda por tipo de cliente</option>
                                            <option value="Cliente">Cliente</option>
                                            <option value="Cliente Potencial">Cliente Potencial</option>
                                            <option value="Colaborador">Colaborador</option>
                                            <option value="Proveedor">Proveedor</option>
                                        </select>
                                        <label for="email-id-column">Tipo</label>
                                    </div>
                                </div>
                            </div>
        
        <table id="oportunityTable" class="table table-hover mb-0 table-responsive">
            <thead>
                <tr>
                    <th style="text-align:center;" width="20%">Nombre</th>
                    <th style="text-align:center;" width="20%">Apellido</th>
                    <th style="text-align:center;" width="20%">Teléfono</th>
                    <th style="text-align:center;" width="20%">Email</th>
                    <th style="text-align:center;" width="20%">Empresa</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if($contacts)
                @foreach($contacts as $contact)
                    <tr href="{{route('contact.create', ['contact'=>$contact])}}" class="fila" id="fila{{$contact->id}}">
                    <td style="text-align:center;" width="20%">{{$contact->name}}</td>
                    <td style="text-align:center;" width="20%">{{$contact->last_name}}</td>
                    <td style="text-align:center;" width="20%">{{$contact->phone}}</td>
                    <td style="text-align:left;" width="20%">{{$contact->email}}</td>
                    <td style="text-align:left;" width="20%">{{$contact->company}}
                    <input type="text" class="tipoContacto" value="{{$contact->type}}" data-id="{{$contact->id}}" hidden>
                    </td>
                    <td>
                        @if($contact->favorite)
                            <i class="ficon feather icon-star warning"></i>
                        @endif
                    </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
