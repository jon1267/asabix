<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\TagTranslation;
use App\Models\Language;

class TagRepository
{
    public function createTag($request): array
    {
        try {
            Tag::create($request->validated());

            $result['body'] = ['success' => true, 'message'=> 'Tag was created'];
            $result['status_kod'] = 200;

        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }

    public function updateTag($request, $id): array
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->update($request->validated());

            $result['body'] = ['success' => true, 'message'=> 'Tag was updated'];
            $result['status_kod'] = 200;

        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }

    public function deleteTag($id): array
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->posts()->delete();
            $tag->tagTranslations()->delete();
            $tag->delete();

            $result['body'] = ['success' => true, 'message'=> 'Tag was deleted'];
            $result['status_kod'] = 200;

        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }

    public function createTagTranslations($request): array
    {
        try {
            $tag = Tag::findOrFail($request->tag_id);
            $tag_id = $tag->id;
            $tagTranslations = $request['tag'];

            foreach ($tagTranslations as $item) {
                $language = Language::where('locale', $item['locale'])->first();
                $language_id = $language->id;

                TagTranslation::create([
                    'tag_id' => $tag_id,
                    'language_id' => $language_id,
                    'name' => $item['name']
                ]);
            }

            $result['body'] = ['success' => true, 'message'=> 'Tag translations created'];
            $result['status_kod'] = 200;

        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }

    public function updateTagTranslations($request, $id): array
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag_id = $tag->id;
            $tagTranslations = $request['tag'];

            foreach ($tagTranslations as $item) {
                $language = Language::where('locale', $item['locale'])->first();
                $language_id = $language?->id;

                $updatedRow = TagTranslation::where('tag_id', $tag_id)
                    ->where('language_id', $language_id)
                    ->first();

                $updatedRow?->update([
                    'name' => $item['name'],
                ]);
            }

            $result['body'] = ['success' => true, 'message'=> 'Tag translations updated'];
            $result['status_kod'] = 200;

        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }


    public function deleteTagTranslations($id): array
    {
        try {
            $tagTranslations = TagTranslation::findOrFail($id);
            $tagTranslations->delete();

            $result['body'] = ['success' => true, 'message'=> 'Post was successfully deleted'];
            $result['status_kod'] = 200;
        } catch (\Exception $e) {
            $result['body'] = ['success' => false, 'message' => $e->getMessage()];
            $result['status_kod'] = 400;
        }

        return $result;
    }

}