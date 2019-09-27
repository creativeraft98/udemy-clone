<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $author = $this->author;
        $category = $this->category;
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'approved' => $this->approved,
            'status_code' => $this->status_code,
            'author' => [
                'username' => $author->username,
                'full_name' => $author->full_name
            ],
            'category' => [
                'name' => $category->name,
                'slug' => $category->slug,
                'uuid' => $category->uuid
            ],
            //'category' => new CategoryResource($this->whenLoaded('category')),
            'description' => $this->description,
            'featured' => $this->featured,
            'is_in_cart' => $this->is_in_cart,
            'images' => [
                'thumbnail' => $this->thumbnail,
                'cover_image' => $this->cover_image,
            ],
            'language' => $this->language,
            'level' => $this->level,
            'percent_completed' => $this->percent_completed,
            'price' => $this->price,
            'price_discounted' => $this->price_discounted,
            'published' => $this->published,

            // AUTHOR ONLY
            'total_sales' => $this->settings()->get('total_sales', 0),
            'sales_this_month' => $this->settings()->get('sales_this_month', 0),
            'enrolled_this_month' => $this->settings()->get('enrolled_this_month', 0),
            'durationHMS' => $this->settings()->get('durationHMS', '00:00:00'),

            'short_description' => $this->short_description,
            'slug' => $this->slug,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            
            // KPIs
            'average_review' => $this->settings()->get('average_rating', 0),
            'total_reviews' => $this->settings()->get('total_reviews', 0),
            'total_students' => $this->settings()->get('total_students', 0),
            'total_video_hours' => $this->settings()->get('total_video_hours', 0),
            'total_articles' => $this->settings()->get('total_articles', 0),
            'total_hours' => $this->settings()->get('total_hours', 0),
            'total_lessons' => $this->settings()->get('total_lessons', 0),
            'total_published_lessons' => $this->settings()->get('total_published_lessons', 0),
            
            'updated_at' => $this->updated_at,
            'uuid' => $this->uuid,
            'what_to_learn' => RequirementsResource::collection($this->whenLoaded('what_to_learn')),
            'requirements' => RequirementsResource::collection($this->whenLoaded('requirements')),
            'target_students' => RequirementsResource::collection($this->whenLoaded('target_students')),
            'sections' => SectionResource::collection($this->whenLoaded('sections')),
            //'first_lesson' => new LessonResource($this->first_lesson),
            'tags' => $this->tags
        ];
    }
}
