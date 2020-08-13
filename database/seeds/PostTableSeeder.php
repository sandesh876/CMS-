<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Post;
use App\Category;
use App\Tag;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' =>'News'
        ]);

        $author1 = App\User::create([
            'name' => 'Lucifer',
            'email'=>'lucifer@gmail.com',
            'password' => Hash::make('hello123')
        ]);
        $author2 = App\User::create([
            'name' => 'Anu',
            'email'=>'anu@gmail.com',
            'password' => Hash::make('hello123')
        ]);

        $category2 = Category::create([
            'name' =>'Marketing'
        ]);
        $category3 = Category::create([
            'name' =>'Partnership'
        ]);

        $tag1 = Tag::create([
            'name' =>'job'
        ]);
        $tag2 = Tag::create([
            'name' =>'customer'
        ]);
        $tag3 = Tag::create([
            'name' =>'record'
        ]);


      $post1 = Post::create([
          'title' => 'We relocated our office to a new designed garage',
          'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley',
            'content' => 'the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley',

            'category_id' => $category1->id,
            'image' =>'posts/1.jpeg',
            'user_id' => $author1->id
      ]);

      $post2 = $author2->posts()->create([
        'title' => 'Top 5 brilliant content marketing strategies',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                          the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley',
          'content' => 'the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley',

          'category_id' => $category2->id,
          'image' =>'posts/2.jpg'

    ]);

    $post3 = $author1->posts()->create([
        'title' => 'Best practices for minimalist design with example',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                          the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley',
          'content' => 'the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley',

          'category_id' => $category3->id,
          'image' =>'posts/3.jpg'

    ]);

    $post4 = $author1->posts()->create([
        'title' => 'Congratulate and thank to Maryam for joining our team',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                          the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley',
          'content' => 'the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley',

          'category_id' => $category1->id,
          'image' =>'posts/4.jpg'

    ]);

    $post1->tags()->attach([$tag1->id,$tag3->id]);
    $post2->tags()->attach([$tag1->id,$tag2->id]);
    $post3->tags()->attach([$tag2->id,$tag3->id]);

    }
}
