<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['title', 'description', 'image', 'start_date', 'end_date'];

    public function getStatusAttribute()
    {
        $today = now()->toDateString();

        if ($today < $this->start_date) {
            return 'unactive';
        } elseif ($today > $this->end_date) {
            return 'due';
        }
        return 'active';
    }
}
