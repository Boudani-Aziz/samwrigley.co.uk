<?php

namespace App;

use App\Traits\HasRoutes;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasRoutes;
}
