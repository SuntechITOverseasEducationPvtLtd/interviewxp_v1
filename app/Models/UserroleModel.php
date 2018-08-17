<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class UserroleModel  extends Model
{
    //use SoftDeletes;
    
    protected $table='tbl_roles';


    protected $fillable = ['id',
                           'rolename',
                           'rolecount',
                           'status'
                             
                           ];
}



class UserrolecategoryModel  extends Model
{
    //use SoftDeletes;
    
    protected $table='tbl_rolecategory';


    protected $fillable = ['id',
                           'rcname',
                           'fieldname',
                            'status'
                             
                           ];
}



class UserrolenameModel  extends Model
{
    //use SoftDeletes;
    
    protected $table='tbl_rolename';


    protected $fillable = ['id',
                           'categoryid',
                            'rolename',
                            'status'
                             
                           ];
}




class UserroleassignModel  extends Model
{
    //use SoftDeletes;
    
    protected $table='tbl_roles_assign';


    protected $fillable = ['id',
                           'roleid',
                            'roeassignid',
                            'rolecategoryid',
                            'status'
                             
                           ];
}

class UserroleassignlModel  extends Model
{
    //use SoftDeletes;
    
 protected $table='role_users';


    protected $fillable = ['id',
                           'user_id',
                            'role_id',
                            'roles_id'
                             ];
}





