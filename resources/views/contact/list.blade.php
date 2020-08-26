<ul class="list-group list-group-flush">
    @foreach($contacts as $contact)
        <li class="list-group-item mb-05">
            <a href="{{route('contact.detail', ['contact' => $contact->id])}}" title="{{ $contact->fullName }}">
                <span class="float-right">
                    
                </span>
                <div class=row>
                     <div class="col-lg-1 col-md-1 col-sm-1 center">
                         <div class="mx-auto text-center mx-auto my-1">
                            @if ($contact->image != null)
                                <div class="avatar avatar-xl">
                                    <img class="img-fluid" src="/{{$contact->image}}" alt="{{ $contact->fullName }}">
                                </div>
                            @else
                                <div class="avatar bg-primary mr-1 avatar-lg">
                                    <div class="avatar-content">
                                        <strong>{{$contact->IntialsName}}</strong>
                                    </div>
                                </div>
                            @endif
                         </div>
                     </div>

                     <div class="col-lg-9 col-md-9 col-sm-9" >
                            <div class="title-contact">{{ $contact->fullName }}</div>
                            @empty($contact->type)
                            @else
                            <p class="card-text  mb-0">{{$contact->type}}</p>
                            @endisset
                            <div>{{$contact->email}}</div>
                            <p class="card-text  mb-0">{{$contact->phone}}</p>
                     </div>

                     <div class="col-lg-2 col-md-2 col-sm-2 center">
                         <div class="mx-auto text-center mx-auto">
                             
                             <div class=" mr-1 my-3 waves-effect waves-light">
                                 @if($contact->favorite)
                                
                                    <i class="ficon feather icon-star text-warning list-contact"></i>
                                
                            @endif
                                <i class="{{App\Contact::getIcon($contact->type_contact)}} list-contact"></i>
                             </div>
                         </div>
                     </div>

                </div>
            </a>
        </li>
    @endforeach
</ul>

{{ $contacts->links() }}
