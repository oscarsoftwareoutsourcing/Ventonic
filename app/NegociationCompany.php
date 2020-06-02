<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NegociationCompany extends Model
{
    protected $table = 'negociations_company';
    protected $fillable = ['user_id','seller_profile_id', 'status_negociations_id', 'producto', 'responsable', 'importe'];

    public function sellerProfile(){
        return $this->belongsTo('App\SellerProfile', 'seller_profile_id');
    }

    public function statusNegociation(){
        return $this->belongsTo('App\StatusNegociation', 'status_negociations_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function dateNegociation($id){
        $postulation=NegociationCompany::where('id',(int)$id)->value('created_at');
        $date=date('d-m-Y', strtotime($postulation));
        
        return $date;
    }

    public static function statusClass($estatus_id, $user_type){
        $class='';
        if($estatus_id==1 && $user_type=='E'){
            $class='chip chip-danger';
        }
        else if($estatus_id==2 && $user_type=='E'){
            $class='chip chip-success';
        }
        else if($estatus_id==3 && $user_type=='E'){
            $class='chip chip-warning';
        }
        else if($estatus_id==4 && $user_type=='V'){
            $class='chip chip-danger';
        }
        else if($estatus_id==5 && $user_type=='V'){
            $class='chip chip-success';
        }
        else if($estatus_id==6 && $user_type=='V'){
            $class='chip chip-warning';
        }

        // Para que tomeen la clase directamente cuando la empresa cambien el status
        else if($estatus_id==1){
            $class='chip chip-danger';
        }
        else if($estatus_id==2){
            $class='chip chip-success';
        }
        else if($estatus_id==3){
            $class='chip chip-warning';
        }
        return $class;
    }

    public static function textStatus($estatus_id, $user_type){
        $text='';
        if($estatus_id==1 && $user_type=='E'){
            $text='No conseguida';
        }
        else if($estatus_id==1 && $user_type=='V'){
            $text='Negociacion no ganada';
        }

        else if($estatus_id==2 && $user_type=='E'){
            $text='Conseguida';
        }
        else if($estatus_id==2 && $user_type=='V'){
            $text='Negociacion ganada';
        }

        else if($estatus_id==3 && $user_type=='E'){
            $text='En proceso';
        }
        else if($estatus_id==3 && $user_type=='V'){
            $text='Negociacion en proceso';
        }

        return $text;
    }

}
