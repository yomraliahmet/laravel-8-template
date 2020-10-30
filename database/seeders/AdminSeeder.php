<?php
namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Image;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name'          => 'Admin',
            'email'         => 'admin@admin.com',
            'password'      => '123456',
            'is_active'     => true,
        ]);

        $files = glob(public_path("images").'/*');
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }

        $admin->image()->save(new Image([
            'image' => \Intervention::make(database_path("seeders/images/noimage.png")),
        ]));
        $admin->assignRole('admin');
    }
}
