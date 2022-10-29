<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class City extends Model
{
    use HasFactory, ElasticquentTrait;
    protected $fillable = ['name'];
    protected $mappingProperties = array(
        'title' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'body' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'tags' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
    );
}
