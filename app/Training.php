<?php

namespace App;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Training extends Model
{
    use Searchable;
    use Sortable;
    protected $fillable = ['title','description','type_id','filename','url','original_name','size','mime_type','extension'];

    public $sortable=['title','description','created_at'];


    public function types()
    {
        return $this->hasMany('App\TrainingType','id','type_id');
    }


    public function getIconAttribute()
    {
        $ext=$this->attributes['extension'];
        $medias_map_collection= collect([ 'fas fa-file-pdf' => ['pdf','txt'],
        'fas fa-video' => ['mov','mp4','mpg','mpeg','ogv','webm'],
        'fas fa-volume-up' => ['wav','mp3'],
        'far fa-image' => ['jpeg','png','bmp','gif','svg','jpg']
        ]);
        
        $filtered = $medias_map_collection->filter(function ($value, $key) use ($ext) {
                   $value_collection=collect($value);
               return $value_collection->contains($ext);
        });
        return $filtered->keys()->last();
    }

   public function scopeSearch($query,$keyword)
   {
        return $query->where("title","LIKE","%".$keyword."%")
        ->orWhere("description","LIKE","%".$keyword."%");
   }

   public function scopeSearchExtension($query,$extension)
   {    
    if (!empty($extension))
       {

        $medias_map= [ '1' => "pdf,txt",
                       '2' => "mov,mp4,mpg,mpeg,ogv,webm",
                       '3' => "wav,mp3",
                       '4' => "jpeg,png,bmp,gif,svg"
       ];
        $extension=explode(",",$medias_map[$extension]);
      
        return $query->whereIn("extension",$extension);
       }
   }

   public function scopeSearchCategory($query,$type_ids)
   {   
       if (!empty($type_ids))
       {
        return $query->where("type_id","=",$type_ids);
       }
   }
   

    public function searchableAs()
    {

            return 'title';

    }
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

}
