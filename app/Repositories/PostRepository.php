<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Language;

class PostRepository
{
    /**
     * create Post with PostTranslations
     * @param $request
     * @return array
     */
    public function createPost($request): array
    {
        try {
            $post = Post::create();
            $post_id = $post->id;

            $postTranslations = $request['post'];

            if (is_array($postTranslations)) {
                foreach ($postTranslations as $item) {
                    $language = Language::where('locale', $item['locale'])->first();
                    $language_id = $language->id;

                    PostTranslation::create([
                        'post_id' => $post_id,
                        'language_id' => $language_id,
                        'title' => $item['title'],
                        'description' => $item['description'],
                        'content' => $item['content'],
                    ]);
                }
            }

            $result['body'] = ['success' => true, 'message'=> 'Post with translations created'];
            $result['status_kod'] = 200;

        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }

    /**
     * update Post with PostTranslations
     * @param $request
     * @param $id
     *
     * @return array
     */
    public function updatePost($request, $id): array
    {
        try {
            $post = Post::findOrFail($id);
            $postId = $post->id;
            $postTranslations = $request['post'];

            if (is_array($postTranslations)) {
                foreach ($postTranslations as $item) {
                    $language = Language::where('locale', $item['locale'])->first();
                    $language_id = $language->id;

                    $updatedTranslation = PostTranslation::where('post_id', $postId)
                        ->where('language_id', $language_id)
                        ->first();

                    $updatedTranslation?->update([
                        'title'       => $item['title'],
                        'description' => $item['description'],
                        'content'     => $item['content'],
                    ]);
                }
            }

            $result['body'] = ['success' => true, 'message'=> 'Post with translations updated'];
            $result['status_kod'] = 200;

        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }

    public function deletePost($id): array
    {
        try {
            $post = Post::findOrFail($id);

            $post->postTranslations()->delete();
            $post->tags()->delete();
            $post->delete();

            $result['body'] = ['success' => true, 'message'=> 'Post was successfully deleted'];
            $result['status_kod'] = 200;
        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }
}