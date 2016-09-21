<?php 
	namespace App\Models;
	use Illuminate\Database\Eloquent\Model;

	class Onlineuser extends Model
	{
		public $timestamps = false;
		protected $fillable = ['reportTime'];
	}
