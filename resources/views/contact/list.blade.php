<ul class="list-group list-group-flush">
    @foreach($contacts as $contact)
        <li class="list-group-item">
            <a href="{{route('contact.detail', ['contact'=>$contact['id']])}}" title="{{ $contact['fullName'] }}">
                <span class="float-right">
                    @if($contact['favorite'])
                        <span class="badge badge-pill badge-lg  badge-warning">
                            <i class="ficon feather icon-star text-white"></i>
                        </span>
                    @endif
                    <span class="badge badge-pill badge-lg">
                        <i class="{{App\Contact::getIcon($contact['type_contact'])}} text-white"></i>
                    </span>
                </span>
                <div class=row>
                     <div class="col-lg-1 col-md-1 col-sm-1 center">
                         <div class="mx-auto text-center mx-auto">
                             @if($contact['image'] != null)
                            <div class="avatar avatar-xl">
                                <img class="img-fluid" src="/{{$contact['image']}}" alt="{{ $contact['fullName'] }}">
                            </div>
                            @else
                                <div class="avatar bg-primary mr-1 avatar-lg">
                                    <div class="avatar-content">
                                        <strong>{{$contact['initials']}}</strong>
                                    </div>
                                </div>
                            @endif
                         </div>
                     </div>
                     <div class="col-lg-9 col-md-9 col-sm-9" >
                            <h5>{{ $contact['fullName'] }}</h5>
                            <p class="card-text  mb-0">{{$contact['type']}}</p>
                            <span class="card-text">{{$contact['email']}}</span>
                            <p class="card-text  mb-0">{{$contact['phone']}}</p>
                     </div>
                </div>
            </a>
        </li>
    @endforeach
</ul>

{{ $contacts->links() }}
