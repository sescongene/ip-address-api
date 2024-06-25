<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class IPAddress extends Model
{
    use HasFactory, RevisionableTrait;

    protected $table = 'ip_addresses';

    protected $fillable = [
        'ip_address',
        'label'
    ];
}
