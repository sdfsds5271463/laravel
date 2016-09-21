<?php
	namespace App\Services;
	use Illuminate\Support\ServiceProvider;

	class LaraServiceProvider extends ServiceProvider
	{
		protected $defer = true; //緩載

		public function boot(){
			//boot方法會在所有提供者的register完成後才註冊
		}
		public function register()
		{
			//普通回調函數綁定
			$this->app->bind(onlineUsersAmount::class,function(){
				return new onlineUsersAmount(); 
			});	
			$this->app->bind(stateCode::class,function(){
				return new stateCode(); 
			});	
		}
		public function provides() //緩載時要提供所有的註冊名
		{
			return [
				onlineUsersAmount::class,
				stateCode::class
			];
		}

	}




/*

<?php 
namespace App\ServiceTest;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
	protected $defer = true; //緩載
	public function boot(){
		//boot方法會在所有提供者的register完成後才註冊
	}
	public function register()
	{
		$this->app->bind(GeneralService::class,function($app){
			return new GeneralService("111");
			});	//普通回調函數綁定
		$this->app->singleton(SingleService::class,function($app){
			return new SingleService();
			}); //單例回調函數綁定
		$instance = new InstanceService();
		$this->app->instance('instanceService',$instance); //實例對象服務綁定
	}


}
