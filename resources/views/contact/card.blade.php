<div class="row">
    @foreach($contacts as $contact)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card collapse-margin">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 center">
                            <div class="mx-auto text-center mx-auto">
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
                            <h5>{{ $contact->fullName }}</h5>
                            <p class="card-text  mb-0">{{$contact->type}}</p>
                            <span class="card-text">{{$contact->email}}</span>
                            <p class="card-text  mb-0">{{$contact->phone}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-sm-12">{{ $contacts->links() }}</div>
</div>
