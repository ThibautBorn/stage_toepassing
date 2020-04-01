<?php


namespace App\Http\Controllers;


class PostsController
{
    public function show($post){
        $posts = [
            'a' => "aaaaaa",
            'b' => 'bbbbbbbbbb',
            'c' => 'cccccccccccccccccccccccccc,'
        ];

        if (! array_key_exists($post, $posts)){
            abort(404, 'sorry, er was geen post beschikbaar voor deze input');
        }

        return view('posts', [
            'post' => $posts[$post]
        ]);
    }

}
