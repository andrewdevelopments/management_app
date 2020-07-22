<?php

use Illuminate\Database\Seeder;

class ProjectsUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //$user = factory(App\User::class)->create();

        factory(App\User::class, 20)->create()->each(function($user) {

            if( $user->role == 'Admin' ) {
                factory(App\ProjectsUser::class, 2)->create([
                    'user_id' => $user->id,
                    'projects_id' => factory(App\Projects::class),
                ]);
            }

        });

    }
}
