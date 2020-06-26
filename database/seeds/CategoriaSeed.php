<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
        	"nombre" => "Restaurante",
        	"slug" => Str::slug("Restaurantes"),
        	"created_at" => Carbon::now(),
        	"updated_at" => Carbon::now()

        ]);

         DB::table('categorias')->insert([
        	"nombre" => "Gimnasio",
        	"slug" => Str::slug("Gimnasio"),
        	"created_at" => Carbon::now(),
        	"updated_at" => Carbon::now()

        ]);

           DB::table('categorias')->insert([
        	"nombre" => "Doctor",
        	"slug" => Str::slug("Doctor"),
        	"created_at" => Carbon::now(),
        	"updated_at" => Carbon::now()

        ]);

             DB::table('categorias')->insert([
        	"nombre" => "bares",
        	"slug" => Str::slug("bares"),
        	"created_at" => Carbon::now(),
        	"updated_at" => Carbon::now()

        ]);

               DB::table('categorias')->insert([
        	"nombre" => "café",
        	"slug" => Str::slug("café"),
        	"created_at" => Carbon::now(),
        	"updated_at" => Carbon::now()

        ]);
    }
}
