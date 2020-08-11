 
                    <div class="">
                      
                        <table id="datatable" class="table  oportunityTable data-list-view table-hover mb-0 table-responsive">
                            <thead>
                                <tr>
                                    <th style="text-align:center;" width="20%">Nombre</th>
                                    <th style="text-align:center;" width="20%">Apellido</th>
                                    <th style="text-align:center;" width="10%">Telefono</th>
                                    <th style="text-align:center;" width="20%">Email</th>
                                    <th style="text-align:center;" width="20%">Empresa</th>
                                    <th style="text-align:center;" width="5%">Favoritos</th>
                                    <th style="text-align:center;" width="5%">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)

                                <tr  class="fila" id="fila{{$contact['id']}}">
                                    <td style="text-align:left;" width="20%">
                                        <div class="avatar bg-primary mr-1 avatar-lg">
                                            <div class="avatar-content">
                                                <strong>{{$contact['initials']}}</strong>
                                            </div>
                                        </div>
                                        <span><i class="{{App\Contact::getIcon($contact['type_contact'])}} text-primary"></i></span>
                                        @if($contact['private']==1)
                                        <span style="margin-left:5px;margin-right:5px;"><i class="feather icon-eye"></i></span>
                                        @endif
                                        <span style="margin-left:10px;color:color: #C2C6DC!important;">{{$contact['name']}}</span>
                                    </td>
                                    <td style="text-align:center;" width="20%">{{$contact['last_name']}}</td>
                                    <td style="text-align:center;" width="10%">{{$contact['phone']}}</td>
                                    <td style="text-align:center;" width="15%">{{$contact['email']}}</td>
                                    <td style="text-align:center;" width="15%">{{$contact['company']}}
                                    <input type="text" class="tipoContacto" value="{{$contact['type']}}" data-id="{{$contact['id']}}" hidden>
                                    </td>
                                    <td style="text-align:center;" width="5%">
                                        @if($contact['favorite'])
                                            <i class="ficon feather icon-star warning"></i>
                                        @endif
                                    </td>
                                    <td width="15%" style="text-align:center;">

                                        <a href="{{route('contact.detail', ['contact'=>$contact['id']])}}" class="float-left ml-1">
                                            <i class="feather icon-eye text-white"></i>
                                        </a>
                                        <a href="{{route('contact.editForm',['contact_id'=>$contact['id']])}}" class="float-left  mx-1">
                                            <i class="feather icon-edit text-white"></i>
                                        </a>
                                        <a id="iconDelete" data-toggle="modal"  data-target="#deleteModal" class="float-left" onclick="asignarValores({{$contact['id']}})">
                                            <i class="feather icon-trash-2 text-white"></i>
                                        </a>
                                        <input value="{{$contact['user_id']}}" id="user_id{{$contact['id']}}" data-id="{{$contact['id']}}" hidden>
                                        <input value="{{$contact['id']}}" id="contact_id{{$contact['id']}}" data-id="{{$contact['id']}}" hidden>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12 float-right mt-2">
                        </div>
                    </div>
                    -