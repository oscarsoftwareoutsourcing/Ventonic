@extends('layouts.app-errors')

@section('extra-css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');

.cross {
    padding: 10px;
    color: #d6312d;
    cursor: pointer;
    font-size: 23px
}

.cross i {
    margin-top: -5px;
    cursor: pointer
}

.comment-box {
    padding: 5px
}

.comment-area textarea {
    resize: none;
    border: 1px solid  #10163A;
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #ffffff;
    outline: 0;
    box-shadow: 0 0 0 1px rgba(60, 0, 255, 0.959) !important
}

.send {
    color: #fff;
    background-color: #ff0000;
    border-color: #ff0000
}

.send:hover {
    color: #fff;
    background-color: #f50202;
    border-color: #f50202
}

.rating {
    display: inline-flex;
    margin-top: -10px;
    flex-direction: row-reverse
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 28px;
    font-size: 5em;
    color: #ff0000 !important;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}

.assessment {
    background-color: #fff !important;
    color:  #10163A !important;
}
</style>
@endsection

@section('content')



<div class="card-content">
    <div class="text-center card-body">
        <img src="{{ asset('images/logo/ventonic.png') }}" class="img-fluid align-self-center" alt="branding logo">
            
            <div class="my-2 mr-1 card">
                
                <div class="card-body">
                    <section class="page-users-view">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                        <div class="users-view-image">
                                <img src="{{ asset('images/anonymous-user.png') }}" alt="avatar" class="pr-2 mb-2 ml-1 rounded users-avatar-shadow w-100">
                            </div> 
                        </div> 
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Nombre</td> 
                                        <td>Vendedor</td>
                                    </tr> 
                                    <tr><td class="font-weight-bold">Apellido</td> 
                                        <td>Uno</td>
                                    </tr> 
                                
                                    
                                </tbody>
                            </table>
                        </div> 
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tbody>
                                    <tr>
                                        <td class="text-right font-weight-bold">
                                        <i class="feather icon-star"></i>
                                        <i class="feather icon-star"></i>
                                        <i class="feather icon-star"></i>
                                        <i class="feather icon-star"></i>
                                        <i class="feather icon-star"></i>
                                        4.5
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </section>
                </div>
            </div>

            <div class="text-center comment-box">
                    
                    <div class="rating"> 
                        <input type="radio" name="rating" value="5" id="5"><label for="5" class="mr-1">☆</label> 
                        <input type="radio" name="rating" value="4" id="4"><label for="4"  class="mr-1">☆</label> 
                        <input type="radio" name="rating" value="3" id="3"><label for="3"  class="mr-1">☆</label> 
                        <input type="radio" name="rating" value="2" id="2"><label for="2" class="mr-1">☆</label> 
                        <input type="radio" name="rating" value="1" id="1"><label for="1"  class="mr-1">☆</label> 
                    </div>
                    <h4>Deja un comentario de tu experiencia. Valora la profesionalidad, amabilidad, disponibilidad del vendedor con el que has trabajado, así como cualquier otro aspecto que quieras compartir para que el resto de Empresas que accedan a su perfil puedan conocer. </h4>
                    <div class="comment-area"> 
                        <textarea class="form-control assessment" placeholder="Comentario" rows="4"></textarea> 
                    </div>
                    <div class="text-center"> <a class="mt-2 btn btn-primary btn-lg btn-block" >Valorar <i class="ml-1 fa fa-long-arrow-right"></i></a> </div>
            </div>
            
    </div>
</div>

@endsection