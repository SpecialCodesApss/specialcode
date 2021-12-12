<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["question_ar","question_en","answer_ar","answer_en","active","sort"];
}
