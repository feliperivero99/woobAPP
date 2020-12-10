<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'direccion',
        'updated_at',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */



    public static function createuser($array = false, $password = false)
    {




        $user = new User();
        $user->nombre = $array["nombre"];
        $user->apellido = $array["apellido"];
        $user->telefono = $array["telefono"] ;
        $user->email = $array["email"] ;
        $user->direccion = $array["direccion"] ;
        $user->save();
        return $user;

    }

    public static function edituser($array = false)
    {

        $user = User::where("id", $array["iduser"])->first();


        if($user == null){
            return null;
        }
   
      


        

        $user->nombre = $array["nombre"];
        $user->apellido = $array["apellido"];
        $user->telefono = $array["telefono"] ;
        $user->direccion = $array["direccion"] ;
        $user->email = $array["email"] ;
        $user->save();
        return $user;
       

    

    }

    public static function deleteuser($id = false){

        $user = User::where("id", $id)->first();


        if($user == null){
            return null;
        }
        $user->status="T";
        $user->save();

        return $user;
    }

  
    public static function getActiveUserslist()
    {
        $users = User::where('status', 'A')->get();
        $userlsit = array();
        $contador = 0;
        foreach ($users as $vt) {
            //dd($vt);
            $userlsit[$contador]["id"] = $vt->id;
            $userlsit[$contador]["pos"] = $contador + 1;

            $userlsit[$contador]["nombre"] = $vt->nombre;
            $userlsit[$contador]["apellido"] = $vt->apellido;
            $userlsit[$contador]["telefono"] = $vt->telefono;
            $userlsit[$contador]["email"] = $vt->email;
            $userlsit[$contador]["direccion"] = $vt->direccion;
     
            $userlsit[$contador]["created_at"] = $vt->created_at;
       
            $contador++;
        }

        return $userlsit;
    } //

    public static function searchuser($text = false, $rol = false){

        
        $users = User::where('status', 'A');

        if($text != null && $text != ""){
            
            $users->where(function ($query) use ($text) {
                $query->orWhere('nombre', 'LIKE', '%' . $text . '%');
                $query->orWhere('apellido', 'LIKE', '%' . $text . '%');
                $query->orWhere('telefono', 'LIKE', '%' . $text . '%');
                $query->orWhere('email', 'LIKE', '%' . $text . '%');
                
                $query->orWhere('direccion', 'LIKE', '%' . $text . '%');
            });
        }
        
     
     
        $users =$users->get();
        

        $userlsit = array();
        $contador = 0;
        foreach ($users as $vt) {
            //dd($vt);
            $userlsit[$contador]["id"] = $vt->id;
            $userlsit[$contador]["pos"] = $contador + 1;

            $userlsit[$contador]["nombre"] = $vt->nombre;
            $userlsit[$contador]["apellido"] = $vt->apellido;
            $userlsit[$contador]["telefono"] = $vt->telefono;
            $userlsit[$contador]["email"] = $vt->email;
            $userlsit[$contador]["direccion"] = $vt->direccion;
     
            $userlsit[$contador]["created_at"] = $vt->created_at;
            $contador++;
        }

        return $userlsit;
    }


}