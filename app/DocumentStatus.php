<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentStatus extends Model
{
	protected $fillable = [
	    'document_id', 'user_id', 'status',
	];
    protected $table = 'document_status';
    
    public $timestamps = true;
}
