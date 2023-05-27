<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getColumns()
    {
        return Schema::getColumnListing($this->table);
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->from || $request->to) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to =  Carbon::parse($request->to)->endOfDay();
            $query->whereBetween($this->table . '.created_at', [$from, $to]);
        }
        return $query;
    }
}
