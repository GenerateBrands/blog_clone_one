<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**[Illuminate\Database\QueryException] SQLSTATE[42000]:
 *Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
 *(SQL: alter table users add unique users_email_uniq(email))
*/
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        /**[Illuminate\Database\QueryException] SQLSTATE[42000]:
         *Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
         *(SQL: alter table users add unique users_email_uniq(email))
        */
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
